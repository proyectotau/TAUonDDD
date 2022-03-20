<?php

namespace ProyectoTAU\Tests\Integration\CommandBus;

use Exception;
use Mockery;
use PHPUnit\Framework\TestCase;
use ProyectoTAU\CommandBus\CommandBus as LocalCommandBus;
use League\Tactician\Middleware;
use League\Tactician\CommandBus;
use function Webmozart\Assert\Tests\StaticAnalysis\boolean;

class TestLogger
{
    private $logger;

    public function __construct(&$logger)
    {
        $this->logger = &$logger;
    }

    public function __call($name, $message)
    {
        $this->logger = true;
        //printf("\n[%s] %s\n", $name, $message[0]);
    }
}

class LoggerMiddleware implements Middleware
{
    private $logger;

    public function __construct(object $logger)
    {
        $this->logger = $logger;
    }

    public function execute(object $command, callable $next)
    {
        $this->logger->info(\get_class($command));
        $next($command);
    }
}

class TestCommandsRunner implements Middleware
{
    private $runner;
    private $handler;

    public function __construct(&$runner, &$handler)
    {
        $this->runner = &$runner;
        $this->handler = &$handler;
    }

    public function execute(object $command, callable $next)
    {
        $this->runner = true;
        $commandName = \get_class($command);
        $commandHandler = $commandName.'Handler';
        (new $commandHandler($this->handler))->handle($command);
    }
}

class TestCommand
{
}

class TestFailedCommand
{
}

class TestCommandHandler
{
    private $handler;

    public function __construct(&$handler)
    {
        $this->handler = &$handler;
    }

    public function handle(object $command)
    {
        $this->handler = true;
    }
}

class TestFailedCommandHandler
{
    private $handler;

    public function __construct(&$handler)
    {
        $this->handler = &$handler;
    }

    public function handle(object $command)
    {
        $this->handler = true;
        throw new \Exception('Command Failed');
    }
}

class TestTransaction implements Middleware
{
    private $entityManager;
    private $transaction;

    public function __construct(&$transaction, object $entityManager)
    {
        $this->entityManager = $entityManager;
        $this->transaction = &$transaction;
    }

    public function execute(object $command, callable $next)
    {
        $this->entityManager->begin();

        try {

            $next($command);

        } catch (\Exception $e){
            $this->entityManager->rollback();
            //throw $e;
            return;
        } finally {
            $this->transaction = true;
        }

        $this->entityManager->commit();
    }
}

class TestEntityManager
{
    private $begin;
    private $commit;
    private $rollback;

    public function __construct(&$begin, &$commit, &$rollback)
    {
        $this->begin = &$begin;
        $this->commit = &$commit;
        $this->rollback = &$rollback;
    }

    public function begin()
    {
        $this->begin = true;
    }

    public function commit()
    {
        $this->commit = true;
    }

    public function rollback()
    {
        $this->rollback = true;
    }
}

class CommandBusTest extends TestCase
{
     /**
     * @link https://github.com/sebastianbergmann/phpunit-documentation/issues/171#issuecomment-67239415
     */
    function skip_test_can_make_LocalCommandBus_class(){
        try {
            $cmdbus = new LocalCommandBus();
        } catch (\InvalidArgumentException $notExpected) {
            $this->fail();
        }

        $this->assertTrue(TRUE);
    }

    /**
     * @link https://github.com/sebastianbergmann/phpunit-documentation/issues/171#issuecomment-67239415
     */
    function test_can_make_CommandBus_class(){
        try {
            $cmdbus = new CommandBus();
        } catch (\InvalidArgumentException $notExpected) {
            $this->fail();
        }

        $this->assertTrue(TRUE);
    }

    function test_can_make_Middleware_class(){
        $logger = false;
        $runner = false;
        $handler = false;

        $cmdbus = new CommandBus(
            new LoggerMiddleware(new TestLogger($logger)),
            new TestCommandsRunner($runner, $handler)
        );

        $cmdbus->handle(new TestCommand);

        $this->assertTrue($logger, 'Logger failed');
        $this->assertTrue($runner, 'Runner failed');
        $this->assertTrue($handler, 'Handler failed');
    }

    function test_can_make_Commited_Transaction(){
        $logger = false;
        $transaction = false;
        $begin = false;
        $commit = false;
        $rollback = false;

        $cmdbus = new CommandBus(
            new LoggerMiddleware(new TestLogger($logger)),
            new TestTransaction(
                $transaction,
                new TestEntityManager($begin, $commit, $rollback)
            )
        );

        $cmdbus->handle(new TestCommand);

        $this->assertTrue($logger, 'Logger failed');
        $this->assertTrue($transaction, 'Transaction failed');
        $this->assertTrue($begin, 'begin failed');
        $this->assertTrue($commit, 'commit failed');
        $this->assertFalse($rollback, 'rollback failed');
    }

    function test_can_make_Rollbacked_Transaction(){
        $logger = false;
        $transaction = false;
        $begin = false;
        $commit = false;
        $rollback = false;
        $runner = false;
        $handler = false;

        $cmdbus = new CommandBus(
            new LoggerMiddleware(new TestLogger($logger)),
            new TestTransaction(
                $transaction,
                new TestEntityManager($begin, $commit, $rollback)
            ),
            new TestCommandsRunner($runner, $handler)
        );

        $cmdbus->handle(new TestFailedCommand);

        $this->assertTrue($logger, 'Logger failed');
        $this->assertTrue($transaction, 'Transaction failed');
        $this->assertTrue($begin, 'begin failed');
        $this->assertFalse($commit, 'commit failed');
        $this->assertTrue($rollback, 'rollback failed');
        $this->assertTrue($runner, 'Runner failed');
        $this->assertTrue($handler, 'Handler failed');
    }
}
