<?php

namespace Tests\Module\Administration\Role\Application;

use PHPUnit\Framework\TestCase;
use ProyectoTAU\TAU\Common\InMemoryRepository;
use ProyectoTAU\TAU\Module\Administration\Role\Application\addGroupToRole\AddGroupToRole;
use ProyectoTAU\TAU\Module\Administration\Group\Application\getRolesFromGroup\GetRolesFromGroup;
use ProyectoTAU\TAU\Module\Administration\Group\Infrastructure\InMemoryGroupRepository;
use ProyectoTAU\TAU\Module\Administration\Role\Infrastructure\InMemoryRoleRepository;
use ProyectoTAU\TAU\Module\Administration\Group\Domain\Group;
use ProyectoTAU\TAU\Module\Administration\Role\Domain\Role;

class RoleGroupRelationTest extends TestCase
{
    public function testItCanAddGroupToRole()
    {
        InMemoryRepository::getInstance()->clear();

        $roleRepository = new InMemoryRoleRepository();
        $groupRepository = new InMemoryGroupRepository();

        $roleRepository->create($role = new Role(0, "Test", "Dummy"));
        $groupRepository->create($group = new Group(0, "Test", "Dummy"));

        $addGroupToRoleService = new AddGroupToRole($groupRepository, $roleRepository);
        $addGroupToRoleService->addGroupToRole(0, 0);

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

        InMemoryRepository::getInstance()->addGroupToRole($group, $role);

        $getRolesFromGroupService = new GetRolesFromGroup($groupRepository);
        $actual = $getRolesFromGroupService->getRolesFromGroup(0);

        $this->assertSame([
            'grants' => [
                $role
            ],
            'available' => []
        ], $actual);
    }
}
