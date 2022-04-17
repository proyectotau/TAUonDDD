<?php

namespace ProyectoTAU\Tests\Module\Administration\Group\Application;

use PHPUnit\Framework\TestCase;
use ProyectoTAU\TAU\Common\InMemoryRepository;
use ProyectoTAU\TAU\Module\Administration\Group\Domain\Group;
use ProyectoTAU\TAU\Module\Administration\Group\Infrastructure\InMemoryGroupRepository;
use ProyectoTAU\TAU\Module\Administration\Role\Application\removeGroupFromRole\RemoveGroupFromRoleCommand;
use ProyectoTAU\TAU\Module\Administration\Role\Application\removeGroupFromRole\RemoveGroupFromRoleCommandHandler;
use ProyectoTAU\TAU\Module\Administration\Role\Application\RoleService;
use ProyectoTAU\TAU\Module\Administration\Role\Domain\Role;
use ProyectoTAU\TAU\Module\Administration\Role\Infrastructure\InMemoryRoleRepository;

class GroupRoleRelationTest  extends TestCase
{
    public function testItCanAddGroupToRole()
    {
        InMemoryRepository::getInstance()->clear();

        $roleRepository = new InMemoryRoleRepository();
        $groupRepository = new InMemoryGroupRepository();

        $roleRepository->create($role = new Role(0, "Test", "Dummy"));
        $groupRepository->create($group = new Group(0, "Test", "Dummy"));

        RoleService::addGroupToRole(0,0);

        //$handler = new AddGroupToRoleCommandHandler($groupRepository, $roleRepository);
        //$handler->handle(new AddGroupToRoleCommand(0,0));

        $actual = InMemoryRepository::getInstance()->getGroupsFromRole($role);

        $this->assertSame([
            'grantedby' => [
                            $group
                        ],
            'available' => []
        ], $actual);
    }

    public function testItCanGetGroupsFromRole()
    {
        InMemoryRepository::getInstance()->clear();

        $roleRepository = new InMemoryRoleRepository();
        $groupRepository = new InMemoryGroupRepository();

        $roleRepository->create($role = new Role(0, "Test", "Dummy"));
        $groupRepository->create($group = new Group(0, "Test", "Dummy"));

        InMemoryRepository::getInstance()->addGroupToRole($group, $role);

        $actual = RoleService::getGroupsFromRole(0);

        //$handler = new GetGroupsFromRoleCommandHandler($roleRepository);
        //$actual = $handler->handle(new GetGroupsFromRoleCommand(0));

        $this->assertSame([
            'grantedby' => [
                            $group
                        ],
            'available' => []
        ], $actual);
    }

    public function testICanRemoveGroupFromRole()
    {
        InMemoryRepository::getInstance()->clear();

        $roleRepository = new InMemoryRoleRepository();
        $groupRepository = new InMemoryGroupRepository();

        $roleRepository->create($role = new Role(0, "Test", "Dummy", "fakelogin"));
        $groupRepository->create($group = new Group(0, "Test", "Dummy"));

        InMemoryRepository::getInstance()->addGroupToRole($group, $role);

        RoleService::removeGroupFromRole(0, 0);

        //$handler = new RemoveGroupFromRoleCommandHandler($groupRepository, $roleRepository);
        //$handler->handle(new RemoveGroupFromRoleCommand(0, 0));

        $actual = InMemoryRepository::getInstance()->getGroupsFromRole($role);

        $this->assertSame([
            'grantedby' => [
            ],
            'available' => [
                $group
            ]
        ], $actual);
    }
}
