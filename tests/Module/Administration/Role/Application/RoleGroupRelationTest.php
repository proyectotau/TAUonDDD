<?php

namespace ProyectoTAU\Tests\Module\Administration\Role\Application;

use PHPUnit\Framework\TestCase;
use ProyectoTAU\TAU\Common\AssertsArraySubset;
use ProyectoTAU\TAU\Common\InMemoryRepository;
use ProyectoTAU\TAU\Module\Administration\Group\Domain\Group;
use ProyectoTAU\TAU\Module\Administration\Role\Domain\Role;
use ProyectoTAU\TAU\Module\Administration\Group\Application\addRoleToGroup\AddRoleToGroupCommand;
use ProyectoTAU\TAU\Module\Administration\Group\Application\addRoleToGroup\AddRoleToGroupCommandHandler;
use ProyectoTAU\TAU\Module\Administration\Group\Application\getRolesFromGroup\GetRolesFromGroupCommand;
use ProyectoTAU\TAU\Module\Administration\Group\Application\getRolesFromGroup\GetRolesFromGroupCommandHandler;
use ProyectoTAU\TAU\Module\Administration\Group\Application\removeRoleFromGroup\RemoveRoleFromGroupCommand;
use ProyectoTAU\TAU\Module\Administration\Group\Application\removeRoleFromGroup\RemoveRoleFromGroupCommandHandler;
use ProyectoTAU\TAU\Module\Administration\Group\Application\GroupService;

class RoleGroupRelationTest extends TestCase
{
    use AssertsArraySubset;

    public function testItCanAddRoleToGroup()
    {
        $roleRepository = app()->get('ProyectoTAU\TAU\Module\Administration\Role\Domain\RoleRepository');
        $roleRepository->clear();
        $groupRepository = app()->get('ProyectoTAU\TAU\Module\Administration\Group\Domain\GroupRepository');
        $groupRepository->clear();

        $roleRepository->create($role = new Role(0, "Test", "Dummy"));
        $groupRepository->create($group = new Group(0, "Test", "Dummy"));

        //GroupService::addRoleToGroup(0, 0);

        $handler = new AddRoleToGroupCommandHandler($roleRepository, $groupRepository);
        $handler->handle(new AddRoleToGroupCommand(0,0));

        $actual = $groupRepository->getRolesFromGroup($group);

        $expected = [
            'plays' => [
                $role
            ],
            'available' => []
        ];
        $message = '';
        $result = $this->AssertsArrayIsASubsetOf($expected, $actual, $message);
        $this->assertTrue($result, $message);
    }

    public function testItCanGetRolesFromGroup()
    {
        $roleRepository = app()->get('ProyectoTAU\TAU\Module\Administration\Role\Domain\RoleRepository');
        $roleRepository->clear();
        $groupRepository = app()->get('ProyectoTAU\TAU\Module\Administration\Group\Domain\GroupRepository');
        $groupRepository->clear();

        $roleRepository->create($role = new Role(0, "Test", "Dummy"));
        $groupRepository->create($group = new Group(0, "Test", "Dummy"));

        $groupRepository->addRoleToGroup($role, $group);

        //$actual = GroupService::getRolesFromGroup(0);

        $handler = new GetRolesFromGroupCommandHandler($groupRepository);
        $actual = $handler->handle(new GetRolesFromGroupCommand(0));

        $expected = [
            'plays' => [
                $role
            ],
            'available' => []
        ];
        $message = '';
        $result = $this->AssertsArrayIsASubsetOf($expected, $actual, $message);
        $this->assertTrue($result, $message);
    }

    public function testItCanRemoveRoleFromGroup()
    {
        $roleRepository = app()->get('ProyectoTAU\TAU\Module\Administration\Role\Domain\RoleRepository');
        $roleRepository->clear();
        $groupRepository = app()->get('ProyectoTAU\TAU\Module\Administration\Group\Domain\GroupRepository');
        $groupRepository->clear();

        $roleRepository->create($role = new Role(0, "Test", "Dummy", "fakelogin"));
        $groupRepository->create($group = new Group(0, "Test", "Dummy"));

        $groupRepository->addRoleToGroup($role, $group);

        //GroupService::removeRoleFromGroup(0);

        $handler = new RemoveRoleFromGroupCommandHandler($roleRepository, $groupRepository);
        $handler->handle(new RemoveRoleFromGroupCommand(0, 0));

        $actual = $groupRepository->getRolesFromGroup($group);

        $expected = [
            'plays' => [
            ],
            'available' => [
                $role
            ]
        ];
        $message = '';
        $result = $this->AssertsArrayIsASubsetOf($expected, $actual, $message);
        $this->assertTrue($result, $message);
    }
}
