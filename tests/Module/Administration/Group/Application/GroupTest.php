<?php

namespace Tests\Module\Administration\Group\Application;

use Mockery;
use Mockery\Adapter\Phpunit\MockeryTestCase as TestCase;
use ProyectoTAU\TAU\Module\Administration\Group\Domain\Group;
use ProyectoTAU\TAU\Module\Administration\Group\Domain\GroupRepository;
use ProyectoTAU\TAU\Module\Administration\Group\Application\create\CreateGroup;
use ProyectoTAU\TAU\Module\Administration\Group\Application\read\ReadGroup;
use ProyectoTAU\TAU\Module\Administration\Group\Application\update\UpdateGroup;
use ProyectoTAU\TAU\Module\Administration\Group\Application\delete\DeleteGroup;

class DummyGroupRepository implements GroupRepository {

    public function create(Group $group): void
    {
        // Should receive a call once with the same Dummy Group as argument
        if( ! ($group->getId() === 0 &&
            $group->getName() === 'Test' &&
            $group->getDesc() === 'Dummy') )
            throw new \InvalidArgumentException("Mismatched Group received by create method");
    }

    public function read($id): Group
    {
        // Should receive a call with id === 0
        if( ! ($id === 0) ) {
            throw new \InvalidArgumentException("Mismatched Group received by read method");
        }
    }
    public function update($id, $name, $desc): void
    {
        // Should receive a call once with the same Dummy Group as argument
        if( ! ($id === 0 &&
            $name === 'Test' &&
            $desc === 'Dummy') )
            throw new \InvalidArgumentException("Mismatched Group received by update method");
    }

    public function delete($id): void
    {
        // Should receive a call with id === 0
        if( ! ($id === 0) ) {
            throw new \InvalidArgumentException("Mismatched Group received by delete method");
        }
    }
}

class GroupTest extends TestCase
{
    public function mockeryTestTearDown()
    {
        Mockery::close();
    }

    public function skipItCanAccessAttribute()
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
    }

    public function testItCanCreateAdminGroup()
    {
        $groupRepository = Mockery::mock(DummyGroupRepository::class);

        $groupRepository->shouldReceive('create')
            ->once()
            ->with(\Hamcrest\Core\IsEqual::equalTo(
                new Group(0, "Test", "Dummy")));

        $group = new CreateGroup($groupRepository);
        $group->create(0, "Test", "Dummy");
    }

    public function testItCanReadAdminGroup()
    {
        $groupRepository = Mockery::mock(DummyGroupRepository::class);

        $groupRepository->shouldReceive('read')->once()->with(0);

        $group = new ReadGroup($groupRepository);
        $group->read(0);
    }

    public function testItCanUpdateAdminGroup()
    {
        $groupRepository = Mockery::mock(DummyGroupRepository::class);
        
        $groupRepository->shouldReceive('update')->once()->with(0, "Test", "Dummy");

        $group = new UpdateGroup($groupRepository);
        $group->update(0, "Test", "Dummy");
    }

    public function testItCanDeleteAdminGroup()
    {
        $groupRepository = Mockery::mock(DummyGroupRepository::class);

        $groupRepository->shouldReceive('delete')->once()->with(0);

        $group = new DeleteGroup($groupRepository);
        $group->delete(0);
    }
}
