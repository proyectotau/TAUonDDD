<?php

namespace ProyectoTAU\Tests\Module\Administration\Role\Application;

use PHPUnit\Framework\TestCase;
use ProyectoTAU\TAU\Common\InMemoryRepository;
use ProyectoTAU\TAU\Module\Administration\Group\Application\addRoleToGroup\AddRoleToGroupCommand;
use ProyectoTAU\TAU\Module\Administration\Group\Application\addRoleToGroup\AddRoleToGroupCommandHandler;
use ProyectoTAU\TAU\Module\Administration\Group\Application\getRolesFromGroup\GetRolesFromGroupCommand;
use ProyectoTAU\TAU\Module\Administration\Group\Application\getRolesFromGroup\GetRolesFromGroupCommandHandler;
use ProyectoTAU\TAU\Module\Administration\Group\Application\GroupService;
use ProyectoTAU\TAU\Module\Administration\Group\Application\removeRoleFromGroup\RemoveRoleFromGroupCommand;
use ProyectoTAU\TAU\Module\Administration\Group\Application\removeRoleFromGroup\RemoveRoleFromGroupCommandHandler;
use ProyectoTAU\TAU\Module\Administration\Role\Application\addGroupToRole\AddGroupToRole;
use ProyectoTAU\TAU\Module\Administration\Role\Application\getGroupsFromRole\GetGroupsFromRole;
use ProyectoTAU\TAU\Module\Administration\Group\Application\getRolesFromGroup\GetRolesFromGroup;
use ProyectoTAU\TAU\Module\Administration\Group\Infrastructure\InMemoryGroupRepository;
use ProyectoTAU\TAU\Module\Administration\Role\Application\RoleService;
use ProyectoTAU\TAU\Module\Administration\Role\Infrastructure\InMemoryRoleRepository;
use ProyectoTAU\TAU\Module\Administration\Group\Domain\Group;
use ProyectoTAU\TAU\Module\Administration\Role\Domain\Role;

class RoleGroupRelationTest extends TestCase
{
    public function testItCanAddRoleToGroup()
    {
        InMemoryRepository::getInstance()->clear();

        $roleRepository = new InMemoryRoleRepository();
        $groupRepository = new InMemoryGroupRepository();

        $roleRepository->create($role = new Role(0, "Test", "Dummy"));
        $groupRepository->create($group = new Group(0, "Test", "Dummy"));

        //$addGroupToRoleService = new AddGroupToRole($groupRepository, $roleRepository);
        //$addGroupToRoleService->addGroupToRole(0, 0);
        GroupService::addRoleToGroup(0, 0);

        //$handler = new AddRoleToGroupCommandHandler($roleRepository, $groupRepository);
        //$handler->handle(new AddRoleToGroupCommand(0,0));

        $actual = InMemoryRepository::getInstance()->getRolesFromGroup($group);

        $this->assertSame([
            'plays' => [
                $role
            ],
            'available' => []
        ], $actual);
    }

    public function testItCanGetRolesFromGroup()
    {
        InMemoryRepository::getInstance()->clear();

        $roleRepository = new InMemoryRoleRepository();
        $groupRepository = new InMemoryGroupRepository();

        $roleRepository->create($role = new Role(0, "Test", "Dummy"));
        $groupRepository->create($group = new Group(0, "Test", "Dummy"));

        InMemoryRepository::getInstance()->addRoleToGroup($role, $group);

        $actual = GroupService::getRolesFromGroup(0);

        //$handler = new GetRolesFromGroupCommandHandler($groupRepository);
        //$actual = $handler->handle(new GetRolesFromGroupCommand(0));

        $this->assertSame([
            'plays' => [
                $role
            ],
            'available' => []
        ], $actual);
    }

    public function testItCanRemoveRoleFromGroup()
    {
        InMemoryRepository::getInstance()->clear();

        $roleRepository = new InMemoryRoleRepository();
        $groupRepository = new InMemoryGroupRepository();

        $roleRepository->create($role = new Role(0, "Test", "Dummy", "fakelogin"));
        $groupRepository->create($group = new Group(0, "Test", "Dummy"));

        InMemoryRepository::getInstance()->addRoleToGroup($role, $group);

        //GroupService::removeRoleFromGroup(0);

        $handler = new RemoveRoleFromGroupCommandHandler($roleRepository, $groupRepository);
        $handler->handle(new RemoveRoleFromGroupCommand(0, 0));

        $actual = InMemoryRepository::getInstance()->getRolesFromGroup($group);

        $this->assertSame([
            'plays' => [
            ],
            'available' => [
                $role
            ]
        ], $actual);
    }
}
