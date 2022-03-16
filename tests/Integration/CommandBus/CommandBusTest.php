<?php

namespace ProyectoTAU\Tests\Integration\CommandBus;

use PHPUnit\Framework\TestCase;
use ProyectoTAU\CommandBus\CommandBus;

class CommandBusTest extends TestCase
{
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
}
