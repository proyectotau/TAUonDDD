<?php

namespace ProyectoTAU\Tests\Integration\Services;

use PHPUnit\Framework\TestCase;
use ProyectoTAU\TAU\Module\Administration\Role\Application\RoleService;
use ProyectoTAU\TAU\Module\Administration\Module\Application\ModuleService;

class ModuleServiceTest  extends TestCase
{
    use RepositoriesProvider;

    /**
     * @dataProvider moduleRepositoryProvider
     */
    public function testServiceCanCreateModule($entityManager, $moduleRepository)
    {
        $this->resetCommandBus($entityManager);
        app()->add('ProyectoTAU\TAU\Module\Administration\Module\Domain\ModuleRepository', $moduleRepository);
        $moduleRepository->clear();

        ModuleService::create(1, 'Test', 'Dummy');
        $this->assertTrue(true);
    }

    /**
     * @dataProvider moduleRepositoryProvider
     */
    public function testServiceCanReadModule($entityManager, $moduleRepository)
    {
        $this->resetCommandBus($entityManager);
        app()->add('ProyectoTAU\TAU\Module\Administration\Module\Domain\ModuleRepository', $moduleRepository);
        $moduleRepository->clear();

        ModuleService::create(1, 'Test', 'Dummy');

        ModuleService::read(1);
        $this->assertTrue(true);
    }

    /**
     * @dataProvider moduleRepositoryProvider
     */
    public function testServiceCanUpdateModule($entityManager, $moduleRepository)
    {
        $this->resetCommandBus($entityManager);
        app()->add('ProyectoTAU\TAU\Module\Administration\Module\Domain\ModuleRepository', $moduleRepository);
        $moduleRepository->clear();

        ModuleService::create(1, 'Test', 'Dummy');

        ModuleService::update(1, 'TestOK', 'DummyOK');
        $this->assertTrue(true);
    }

    /**
     * @dataProvider moduleRepositoryProvider
     */
    public function testServiceCanDeleteModule($entityManager, $moduleRepository)
    {
        $this->resetCommandBus($entityManager);
        app()->add('ProyectoTAU\TAU\Module\Administration\Module\Domain\ModuleRepository', $moduleRepository);
        $moduleRepository->clear();

        ModuleService::create(1, 'Test', 'Dummy');

        ModuleService::delete(1);
        $this->assertTrue(true);
    }

    /**
     * @dataProvider roleModuleRepositoriesProvider
     */
    public function testServiceCanAddRoleToModule($entityManager, $roleRepository, $moduleRepository)
    {
        $this->resetCommandBus($entityManager);
        app()->add('ProyectoTAU\TAU\Module\Administration\Role\Domain\RoleRepository', $roleRepository);
        $roleRepository->clear();
        app()->add('ProyectoTAU\TAU\Module\Administration\Module\Domain\ModuleRepository', $moduleRepository);
        $moduleRepository->clear();

        RoleService::create(1, 'Test', 'Dummy');
        ModuleService::create(1, 'Test', 'Dummy');

        ModuleService::addRoleToModule(1, 1);
        $this->assertTrue(true);
    }

    /**
     * @dataProvider roleModuleRepositoriesProvider
     */
    public function testServiceCanGetRolesFromModule($entityManager, $roleRepository, $moduleRepository)
    {
        $this->resetCommandBus($entityManager);
        app()->add('ProyectoTAU\TAU\Module\Administration\Role\Domain\RoleRepository', $roleRepository);
        $roleRepository->clear();
        app()->add('ProyectoTAU\TAU\Module\Administration\Module\Domain\ModuleRepository', $moduleRepository);
        $moduleRepository->clear();

        RoleService::create(1, 'Test', 'Dummy');
        ModuleService::create(1, 'Test', 'Dummy');
        ModuleService::addRoleToModule(1, 1);

        ModuleService::getRolesFromModule(1);
        $this->assertTrue(true);
    }

    /**
     * @dataProvider roleModuleRepositoriesProvider
     */
    public function testServiceCanRemoveRoleFromModule($entityManager, $roleRepository, $moduleRepository)
    {
        $this->resetCommandBus($entityManager);
        app()->add('ProyectoTAU\TAU\Module\Administration\Role\Domain\RoleRepository', $roleRepository);
        $roleRepository->clear();
        app()->add('ProyectoTAU\TAU\Module\Administration\Module\Domain\ModuleRepository', $moduleRepository);
        $moduleRepository->clear();

        RoleService::create(1, 'Test', 'Dummy');
        ModuleService::create(1, 'Test', 'Dummy');
        ModuleService::addRoleToModule(1, 1);

        ModuleService::removeRoleFromModule(1, 1);
        $this->assertTrue(true);
    }
}
