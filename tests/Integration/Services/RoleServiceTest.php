<?php

namespace ProyectoTAU\Tests\Integration\Services;

use PHPUnit\Framework\TestCase;
use ProyectoTAU\TAU\Module\Administration\Group\Application\GroupService;
use ProyectoTAU\TAU\Module\Administration\Role\Application\RoleService;
use ProyectoTAU\TAU\Module\Administration\Module\Application\ModuleService;

class RoleServiceTest  extends TestCase
{
    public function setUp(): void
    {
        $em = app()->get('EntityManager');
        $em->clearGroup();
        $em->clearRole();
        $em->clearModule();
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

    public function testServiceCanAddModuleToRole()
    {
        RoleService::create(1, 'Test', 'Dummy');
        ModuleService::create(1, 'Test', 'Dummy');

        RoleService::addModuleToRole(1,1);
        $this->assertTrue(true);
    }

    public function testServiceCanGetModulesFromRole()
    {
        RoleService::create(1, 'Test', 'Dummy');
        ModuleService::create(1, 'Test', 'Dummy');
        RoleService::addModuleToRole(1,1);

        RoleService::getModulesFromRole(1);
        $this->assertTrue(true);
    }

    public function testServiceCanRemoveModuleFromRole()
    {
        RoleService::create(1, 'Test', 'Dummy');
        ModuleService::create(1, 'Test', 'Dummy');
        RoleService::addModuleToRole(1,1);
        RoleService::getModulesFromRole(1);

        RoleService::removeModuleFromRole(1,1);
        $this->assertTrue(true);
    }
}
