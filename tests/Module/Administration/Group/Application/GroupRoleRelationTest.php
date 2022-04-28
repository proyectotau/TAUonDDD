<?php

namespace ProyectoTAU\Tests\Module\Administration\Group\Application;

use PHPUnit\Framework\TestCase;
use ProyectoTAU\TAU\Common\AssertsArraySubset;
use ProyectoTAU\TAU\Module\Administration\Group\Domain\Group;
use ProyectoTAU\TAU\Module\Administration\Role\Domain\Role;
use ProyectoTAU\TAU\Module\Administration\Role\Application\addGroupToRole\AddGroupToRoleCommand;
use ProyectoTAU\TAU\Module\Administration\Role\Application\addGroupToRole\AddGroupToRoleCommandHandler;
use ProyectoTAU\TAU\Module\Administration\Role\Application\getGroupsFromRole\GetGroupsFromRoleCommand;
use ProyectoTAU\TAU\Module\Administration\Role\Application\getGroupsFromRole\GetGroupsFromRoleCommandHandler;
use ProyectoTAU\TAU\Module\Administration\Role\Application\removeGroupFromRole\RemoveGroupFromRoleCommand;
use ProyectoTAU\TAU\Module\Administration\Role\Application\removeGroupFromRole\RemoveGroupFromRoleCommandHandler;
use ProyectoTAU\TAU\Module\Administration\Role\Application\RoleService;


class GroupRoleRelationTest  extends TestCase
{
    use AssertsArraySubset;

    public function testItCanAddGroupToRole()
    {
        $roleRepository = app()->get('ProyectoTAU\TAU\Module\Administration\Role\Domain\RoleRepository');
        $roleRepository->clear();
        $groupRepository = app()->get('ProyectoTAU\TAU\Module\Administration\Group\Domain\GroupRepository');
        $groupRepository->clear();

        $roleRepository->create($role = new Role(0, "Test", "Dummy"));
        $groupRepository->create($group = new Group(0, "Test", "Dummy"));

        //RoleService::addGroupToRole(0,0);

        $handler = new AddGroupToRoleCommandHandler($groupRepository, $roleRepository);
        $handler->handle(new AddGroupToRoleCommand(0,0));

        $actual = $roleRepository->getGroupsFromRole($role);

        $expected = [
            'grantedby' => [
                $group
            ],
            'available' => []
        ];
        $message = '';
        $result = $this->AssertsArrayIsASubsetOf($expected, $actual, $message);
        $this->assertTrue($result, $message);
    }

    public function testItCanGetGroupsFromRole()
    {
        $roleRepository = app()->get('ProyectoTAU\TAU\Module\Administration\Role\Domain\RoleRepository');
        $roleRepository->clear();
        $groupRepository = app()->get('ProyectoTAU\TAU\Module\Administration\Group\Domain\GroupRepository');
        $groupRepository->clear();

        $roleRepository->create($role = new Role(0, "Test", "Dummy"));
        $groupRepository->create($group = new Group(0, "Test", "Dummy"));

        $roleRepository->addGroupToRole($group, $role);

        //$actual = RoleService::getGroupsFromRole(0);

        $handler = new GetGroupsFromRoleCommandHandler($roleRepository);
        $actual = $handler->handle(new GetGroupsFromRoleCommand(0));

        $expected = [
            'grantedby' => [
                $group
            ],
            'available' => []
        ];
        $message = '';
        $result = $this->AssertsArrayIsASubsetOf($expected, $actual, $message);
        $this->assertTrue($result, $message);
    }

    public function testICanRemoveGroupFromRole()
    {
        $roleRepository = app()->get('ProyectoTAU\TAU\Module\Administration\Role\Domain\RoleRepository');
        $roleRepository->clear();
        $groupRepository = app()->get('ProyectoTAU\TAU\Module\Administration\Group\Domain\GroupRepository');
        $groupRepository->clear();

        $roleRepository->create($role = new Role(0, "Test", "Dummy", "fakelogin"));
        $groupRepository->create($group = new Group(0, "Test", "Dummy"));

        $roleRepository->addGroupToRole($group, $role);

        //RoleService::removeGroupFromRole(0, 0);

        $handler = new RemoveGroupFromRoleCommandHandler($groupRepository, $roleRepository);
        $handler->handle(new RemoveGroupFromRoleCommand(0, 0));

        $actual = $roleRepository->getGroupsFromRole($role);

        $expected = [
            'grantedby' => [
            ],
            'available' => [
                $group
            ]
        ];
        $message = '';
        $result = $this->AssertsArrayIsASubsetOf($expected, $actual, $message);
        $this->assertTrue($result, $message);
    }
}
