<?php

namespace Tests\Module\Administration\Group\Application;

use PHPUnit\Framework\TestCase;
use ProyectoTAU\TAU\Common\InMemoryRepository;
use ProyectoTAU\TAU\Module\Administration\Group\Infrastructure\InMemoryGroupRepository;
use ProyectoTAU\TAU\Module\Administration\Role\Infrastructure\InMemoryRoleRepository;
use ProyectoTAU\TAU\Module\Administration\Group\Application\addRoleToGroup\AddRoleToGroup;
use ProyectoTAU\TAU\Module\Administration\Group\Application\getRolesFromGroup\GetRolesFromGroup;
use ProyectoTAU\TAU\Module\Administration\Role\Application\getGroupsFromRole\GetGroupsFromRole;
use ProyectoTAU\TAU\Module\Administration\Group\Domain\Group;
use ProyectoTAU\TAU\Module\Administration\Role\Domain\Role;

class GroupRoleRelationTest  extends TestCase
{
    public function testItCanAddRoleToGroup()
    {
        InMemoryRepository::getInstance()->clear();

        $roleRepository = new InMemoryRoleRepository();
        $groupRepository = new InMemoryGroupRepository();

        $roleRepository->create($role = new Role(0, "Test", "Dummy"));
        $groupRepository->create($group = new Group(0, "Test", "Dummy"));

        $addRoleToGroupService = new AddRoleToGroup($roleRepository, $groupRepository);
        $addRoleToGroupService->addRoleToGroup(0, 0);

        $actual = InMemoryRepository::getInstance()->getRolesFromGroup($group);

        $this->assertSame([
            'grants' => [
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

        $getRolesFromGroupService = new GetRolesFromGroup($groupRepository);
        $actual = $getRolesFromGroupService->getRolesFromGroup(0);

        $this->assertSame([
            'grants' => [
                            $role
                        ],
            'available' => []
        ], $actual);
    }

    public function testItCanGetAvailableGroupsFromRole()
    {
        InMemoryRepository::getInstance()->clear();

        $roleRepository = new InMemoryRoleRepository();
        $groupRepository = new InMemoryGroupRepository();

        $roleRepository->create($role = new Role(0, "Test", "Dummy", "fakelogin"));
        $groupRepository->create($group1 = new Group(1, "Test1", "Dummy1"));
        $groupRepository->create($group2 = new Group(2, "Test2", "Dummy2"));

        InMemoryRepository::getInstance()->addRoleToGroup($role, $group1);

        $getRolesFromGroupService = new GetGroupsFromRole($roleRepository);
        $actual = $getRolesFromGroupService->getGroupsFromRole(0);

        $this->assertSame([
            'authorizedBy' => [
                1 => $group1
            ],
            'available' => [
                2 => $group2
            ]
        ], $actual);
    }
}
