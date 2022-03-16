<?php

namespace ProyectoTAU\Tests\Integration\CommandBus\Locator;

class HandlerLocator
{
    public function getHandler($handler)
    {
        return app($handler);
    }
}
