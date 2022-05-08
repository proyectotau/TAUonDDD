<?php

namespace ProyectoTAU\TAU\Common;

use League\Tactician\Middleware;

class QueryRunner implements Middleware
{
    private $handler;

    public function __construct($handler = 'Handler')
    {
        $this->handler = $handler;
    }

    public function execute(object $command, callable $next)
    {
        $commandName = \get_class($command);
        $commandHandler = $commandName.$this->handler;
        return app()->get($commandHandler)->handle($command);
    }
}
