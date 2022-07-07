<?php

namespace ProyectoTAU\Tests\Module\Administration\Group\Application;

use Mockery;
use Mockery\Adapter\Phpunit\MockeryTestCase;
use ProyectoTAU\TAU\Module\Administration\Group\Application\readAll\ReadAllGroupsCommand;
use ProyectoTAU\TAU\Module\Administration\Group\Application\readAll\ReadAllGroupsCommandHandler;
use ProyectoTAU\TAU\Module\Administration\Group\Domain\GroupRepository;
use ProyectoTAU\TAU\Module\Administration\Role\Domain\Role;
use ProyectoTAU\TAU\Module\Administration\User\Domain\User;
use ProyectoTAU\TAU\Module\Administration\Group\Domain\Group;
use ProyectoTAU\TAU\Module\Administration\Group\Application\create\CreateGroupCommand;
use ProyectoTAU\TAU\Module\Administration\Group\Application\create\CreateGroupCommandHandler;
use ProyectoTAU\TAU\Module\Administration\Group\Application\read\ReadGroupCommand;
use ProyectoTAU\TAU\Module\Administration\Group\Application\read\ReadGroupCommandHandler;
use ProyectoTAU\TAU\Module\Administration\Group\Application\update\UpdateGroupCommand;
use ProyectoTAU\TAU\Module\Administration\Group\Application\update\UpdateGroupCommandHandler;
use ProyectoTAU\TAU\Module\Administration\Group\Application\delete\DeleteGroupCommand;
use ProyectoTAU\TAU\Module\Administration\Group\Application\delete\DeleteGroupCommandHandler;
use ProyectoTAU\TAU\Module\Administration\Group\Application\GroupService;
use ProyectoTAU\Tests\Module\Administration\User\Application\DummyUserRepository;

class DummyGroupRepository implements GroupRepository {

    public function clear(): void {}

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

        return new Group(0, "Test", "Dummy");
    }

    public function readAll(): array
    {
        return [
            new Group(0,null, null),
            new Group(1,null, null)
        ];
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

    public function addUserToGroup(User $user, Group $group): void {}
    public function addRoleToGroup(Role $role, Group $group): void {}
    public function removeUserFromGroup(User $user, Group $group): void {}
    public function removeRoleFromGroup(Role $roleId, Group $groupId): void {}
    public function getUsersFromGroup(Group $group): array {return [];}
    public function getRolesFromGroup(Group $group): array {return [];}
}

class GroupTest extends MockeryTestCase
{
    public function mockeryTestTearDown()
    {
        Mockery::close();
    }

    public function testItCanCreateAdminGroup()
    {
        $groupRepository = Mockery::mock(DummyGroupRepository::class);

        $groupRepository->shouldReceive('create')
            ->once()
            ->with(\Hamcrest\Core\IsEqual::equalTo(
                new Group(0, "Test", "Dummy")));

        //GroupService::create(0, "Test", "Dummy");

        $handler = new CreateGroupCommandHandler($groupRepository);
        $handler->handle(new CreateGroupCommand(0, "Test", "Dummy"));
    }

    public function testItCanReadAdminGroup()
    {
        $groupRepository = Mockery::mock(DummyGroupRepository::class);

        $groupRepository->shouldReceive('read')->once()->with(0);

        //GroupService::read(0);

        $handler = new ReadGroupCommandHandler($groupRepository);
        $handler->handle(new ReadGroupCommand(0));
    }

    public function testItCanReadAllAdminGroups()
    {
        $groupRepository = Mockery::mock(DummyGroupRepository::class);

        $groupRepository->shouldReceive('readAll')->once();

        //GroupService::readAll();

        $handler = new ReadAllGroupsCommandHandler($groupRepository);
        $handler->handle(new ReadAllGroupsCommand());
    }

    public function testItCanUpdateAdminGroup()
    {
        $groupRepository = Mockery::mock(DummyGroupRepository::class);

        $groupRepository->shouldReceive('update')->once()->with(0, "Test", "Dummy");

        //GroupService::update(0, "Test", "Dummy");

        $handler = new UpdateGroupCommandHandler($groupRepository);
        $handler->handle(new UpdateGroupCommand(0, "Test", "Dummy"));
    }

    public function testItCanDeleteAdminGroup()
    {
        $groupRepository = Mockery::mock(DummyGroupRepository::class);

        $groupRepository->shouldReceive('delete')->once()->with(0);

        //GroupService::delete(0);

        $handler = new DeleteGroupCommandHandler($groupRepository);
        $handler->handle(new DeleteGroupCommand(0));
    }
}
