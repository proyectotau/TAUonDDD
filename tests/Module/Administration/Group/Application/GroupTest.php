<?php

namespace Tests\Module\Administration\User\Application;

use Mockery;
use Mockery\Adapter\Phpunit\MockeryTestCase as TestCase;
use ProyectoTAU\TAU\Module\Administration\User\Domain\Group;

class GroupTest extends TestCase
{
    public function mockeryTestTearDown()
    {
        Mockery::close();
    }


    public function testItCanAccessAttribute()
    {
        $group = new Group(0, "", "");

        $group->id = 1;
        $group->name = 'Administration';
        $group->desc = 'TAU Administration group';

        // $group->nonexist = "ERROR";

        $group->setId(2);
        $group->setName('Group Name');
        $group->setDesc('Group Desc');

        echo $group->getId();
        echo $group->getName();
        echo $group->getDesc();

        $group->setCampo('HOLA');
        echo $this->getCampo();
    }
}
