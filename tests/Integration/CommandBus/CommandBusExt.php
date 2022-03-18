<?php

namespace ProyectoTAU\Tests\Integration\CommandBus;

use ProyectoTAU\CommandBus\CommandBus;

class CommandBusExt extends CommandBus
{
    public function addHandler($cmd, $classhandler)
    {
        parent::bind($cmd, $classhandler);
    }
}
