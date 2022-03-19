<?php

namespace ProyectoTAU\Tests\Integration\CommandBus;

use League\Tactician\Middleware;
use PHPUnit\Framework\TestCase;
use ProyectoTAU\CommandBus\CommandBus as LocalCommandBus;
use League\Tactician\CommandBus;

class TestLogger
{
    private $testcase;

    public function __construct(object $that)
    {
        $this->testcase = $that;
    }

    public function __call($name, $message)
    {
        $this->testcase->assertTrue(TRUE);
        printf("\n[%s] %s\n", $name, $message[0]);
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

class CommandsRunner implements Middleware
{
    public function execute(object $command, callable $next)
    {
        $commandName = \get_class($command);
        $commandHandler = $commandName.'Handler';
        (new $commandHandler)->handle($command);
    }
}

class LocalCommand
{

}

class LocalCommandHandler
{
    public function handle(object $command)
    {
        echo PHP_EOL.\get_class($command).' handled'.PHP_EOL;
    }
}

class CommandBusTest extends TestCase
{
    /**
     * @link https://github.com/sebastianbergmann/phpunit-documentation/issues/171#issuecomment-67239415
     */
    function test_can_make_LocalCommandBus_class(){
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
        $cmdbus = new CommandBus(
            new LoggerMiddleware(new TestLogger($this)),
            new CommandsRunner()
        );

        $cmdbus->handle(new LocalCommand);

        $this->assertTrue(TRUE);
    }
}
