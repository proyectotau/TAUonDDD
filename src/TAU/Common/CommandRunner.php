<?php

namespace ProyectoTAU\TAU\Common;

use League\Tactician\Middleware;

class CommandRunner implements Middleware
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
        return // TODO: remove return from Coomands. It's for Queries only!!!
        app()->get($commandHandler)->handle($command);
    }
}
