<?php

namespace ProyectoTAU\Tests\Integration\CommandBus;

class CommandBusExt extends \ProyectoTAU\CommandBus\CommandBus
{
    public function addHandler($cmd, $classhandler)
    {
        parent::bind($cmd, $classhandler);
    }
}
