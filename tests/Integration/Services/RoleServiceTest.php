<?php

namespace ProyectoTAU\Tests\Integration\Services;

use PHPUnit\Framework\TestCase;
use ProyectoTAU\TAU\Module\Administration\Role\Application\RoleService;
use ProyectoTAU\TAU\Module\Administration\User\Application\UserService;
use ProyectoTAU\TAU\Module\Administration\Group\Application\GroupService;

class RoleServiceTest  extends TestCase
{
    public function setUp(): void
    {
        $em = app()->get('EntityManager');
        $em->clearGroup();
        $em->clearRole();
        $em->clearModule(); //TODO: ModuleRoleRelation missing
    }

    public function testServiceCanCreateRole()
    {
        RoleService::create(1, 'Test', 'Dummy');
        $this->assertTrue(true);
    }

    public function testServiceCanReadRole()
    {
        RoleService::create(1, 'Test', 'Dummy');

        RoleService::read(1);
        $this->assertTrue(true);
    }

    public function testServiceCanUpdateRole()
    {
        RoleService::create(1, 'Test', 'Dummy');

        RoleService::update(1, 'TestOK', 'DummyOK');
        $this->assertTrue(true);
    }

    public function testServiceCanDeleteRole()
    {
        RoleService::create(1, 'Test', 'Dummy');

        RoleService::delete(1);
        $this->assertTrue(true);
    }

    public function testServiceCanAddGroupToRole()
    {
        GroupService::create(1, 'Test', 'Dummy');
        RoleService::create(1, 'Test', 'Dummy');

        RoleService::addGroupToRole(1, 1);
        $this->assertTrue(true);
    }

    public function testServiceCanGetGroupsFromRole()
    {
        GroupService::create(1, 'Test', 'Dummy');
        RoleService::create(1, 'Test', 'Dummy');
        RoleService::addGroupToRole(1, 1);

        RoleService::getGroupsFromRole(1, 1);
        $this->assertTrue(true);
    }

    public function testServiceCanRemoveGroupFromRole()
    {
        GroupService::create(1, 'Test', 'Dummy');
        RoleService::create(1, 'Test', 'Dummy');
        RoleService::addGroupToRole(1, 1);

        RoleService::removeGroupFromRole(1, 1);
        $this->assertTrue(true);
    }
}
