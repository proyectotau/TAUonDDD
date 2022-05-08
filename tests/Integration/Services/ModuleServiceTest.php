<?php

namespace ProyectoTAU\Tests\Integration\Services;

use PHPUnit\Framework\TestCase;
use ProyectoTAU\TAU\Module\Administration\Role\Application\RoleService;
use ProyectoTAU\TAU\Module\Administration\Module\Application\ModuleService;

class ModuleServiceTest  extends TestCase
{
    public function setUp(): void
    {
        $em = app()->get('EntityManager');
        $em->clearRole();
        $em->clearModule();
    }

    public function testServiceCanCreateModule()
    {
        ModuleService::create(1, 'Test', 'Dummy');
        $this->assertTrue(true);
    }

    public function testServiceCanReadModule()
    {
        ModuleService::create(1, 'Test', 'Dummy');

        ModuleService::read(1);
        $this->assertTrue(true);
    }

    public function testServiceCanUpdateModule()
    {
        ModuleService::create(1, 'Test', 'Dummy');

        ModuleService::update(1, 'TestOK', 'DummyOK');
        $this->assertTrue(true);
    }

    public function testServiceCanDeleteModule()
    {
        ModuleService::create(1, 'Test', 'Dummy');

        ModuleService::delete(1);
        $this->assertTrue(true);
    }

    public function testServiceCanAddRoleToModule()
    {
        RoleService::create(1, 'Test', 'Dummy');
        ModuleService::create(1, 'Test', 'Dummy');

        ModuleService::addRoleToModule(1, 1);
        $this->assertTrue(true);
    }

    public function testServiceCanGetRolesFromModule()
    {
        RoleService::create(1, 'Test', 'Dummy');
        ModuleService::create(1, 'Test', 'Dummy');
        ModuleService::addRoleToModule(1, 1);

        ModuleService::getRolesFromModule(1);
        $this->assertTrue(true);
    }

    public function testServiceCanRemoveRoleFromModule()
    {
        RoleService::create(1, 'Test', 'Dummy');
        ModuleService::create(1, 'Test', 'Dummy');
        ModuleService::addRoleToModule(1, 1);

        ModuleService::removeRoleFromModule(1, 1);
        $this->assertTrue(true);
    }
}
