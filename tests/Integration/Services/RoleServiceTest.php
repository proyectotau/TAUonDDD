<?php

namespace ProyectoTAU\Tests\Integration\Services;

use PHPUnit\Framework\TestCase;
use ProyectoTAU\TAU\Module\Administration\Group\Application\GroupService;
use ProyectoTAU\TAU\Module\Administration\Role\Application\RoleService;
use ProyectoTAU\TAU\Module\Administration\Module\Application\ModuleService;

class RoleServiceTest  extends TestCase
{
    use RepositoriesProvider;

    /**
     * @dataProvider roleRepositoryProvider
     */
    public function testServiceCanCreateRole($entityManager, $roleRepository)
    {
        $this->resetCommandBus($entityManager);
        app()->add('ProyectoTAU\TAU\Module\Administration\Role\Domain\RoleRepository', $roleRepository);
        $roleRepository->clear();

        RoleService::create(1, 'Test', 'Dummy');
        $this->assertTrue(true);
    }

    /**
     * @dataProvider roleRepositoryProvider
     */
    public function testServiceCanReadRole($entityManager, $roleRepository)
    {
        $this->resetCommandBus($entityManager);
        app()->add('ProyectoTAU\TAU\Module\Administration\Role\Domain\RoleRepository', $roleRepository);
        $roleRepository->clear();

        RoleService::create(1, 'Test', 'Dummy');

        RoleService::read(1);
        $this->assertTrue(true);
    }

    /**
     * @dataProvider roleRepositoryProvider
     */
    public function testServiceCanReadAllRoles($entityManager, $roleRepository)
    {
        $this->resetCommandBus($entityManager);
        app()->add('ProyectoTAU\TAU\Module\Administration\Role\Domain\RoleRepository', $roleRepository);
        $roleRepository->clear();

        RoleService::create(1, 'Test', 'Dummy');
        RoleService::create(2, 'Test', 'Dummy');

        RoleService::readAll();
        $this->assertTrue(true);
    }

    /**
     * @dataProvider roleRepositoryProvider
     */
    public function testServiceCanUpdateRole($entityManager, $roleRepository)
    {
        $this->resetCommandBus($entityManager);
        app()->add('ProyectoTAU\TAU\Module\Administration\Role\Domain\RoleRepository', $roleRepository);
        $roleRepository->clear();

        RoleService::create(1, 'Test', 'Dummy');

        RoleService::update(1, 'TestOK', 'DummyOK');
        $this->assertTrue(true);
    }

    /**
     * @dataProvider roleRepositoryProvider
     */
    public function testServiceCanDeleteRole($entityManager, $roleRepository)
    {
        $this->resetCommandBus($entityManager);
        app()->add('ProyectoTAU\TAU\Module\Administration\Role\Domain\RoleRepository', $roleRepository);
        $roleRepository->clear();

        RoleService::create(1, 'Test', 'Dummy');

        RoleService::delete(1);
        $this->assertTrue(true);
    }

    /**
     * @dataProvider groupRoleRepositoriesProvider
     */
    public function testServiceCanAddGroupToRole($entityManager, $groupRepository, $roleRepository)
    {
        $this->resetCommandBus($entityManager);
        app()->add('ProyectoTAU\TAU\Module\Administration\Group\Domain\GroupRepository', $groupRepository);
        $groupRepository->clear();
        app()->add('ProyectoTAU\TAU\Module\Administration\Role\Domain\RoleRepository', $roleRepository);
        $roleRepository->clear();

        GroupService::create(1, 'Test', 'Dummy');
        RoleService::create(1, 'Test', 'Dummy');

        RoleService::addGroupToRole(1, 1);
        $this->assertTrue(true);
    }

    /**
     * @dataProvider groupRoleRepositoriesProvider
     */
    public function testServiceCanGetGroupsFromRole($entityManager, $groupRepository, $roleRepository)
    {
        $this->resetCommandBus($entityManager);
        app()->add('ProyectoTAU\TAU\Module\Administration\Group\Domain\GroupRepository', $groupRepository);
        $groupRepository->clear();
        app()->add('ProyectoTAU\TAU\Module\Administration\Role\Domain\RoleRepository', $roleRepository);
        $roleRepository->clear();

        GroupService::create(1, 'Test', 'Dummy');
        RoleService::create(1, 'Test', 'Dummy');
        RoleService::addGroupToRole(1, 1);

        RoleService::getGroupsFromRole(1, 1);
        $this->assertTrue(true);
    }

    /**
     * @dataProvider groupRoleRepositoriesProvider
     */
    public function testServiceCanRemoveGroupFromRole($entityManager, $groupRepository, $roleRepository)
    {
        $this->resetCommandBus($entityManager);
        app()->add('ProyectoTAU\TAU\Module\Administration\Group\Domain\GroupRepository', $groupRepository);
        $groupRepository->clear();
        app()->add('ProyectoTAU\TAU\Module\Administration\Role\Domain\RoleRepository', $roleRepository);
        $roleRepository->clear();

        GroupService::create(1, 'Test', 'Dummy');
        RoleService::create(1, 'Test', 'Dummy');
        RoleService::addGroupToRole(1, 1);

        RoleService::removeGroupFromRole(1, 1);
        $this->assertTrue(true);
    }

    /**
     * @dataProvider roleModuleRepositoriesProvider
     */
    public function testServiceCanAddModuleToRole($entityManager, $roleRepository, $moduleRepository)
    {
        $this->resetCommandBus($entityManager);
        app()->add('ProyectoTAU\TAU\Module\Administration\Role\Domain\RoleRepository', $roleRepository);
        $roleRepository->clear();
        app()->add('ProyectoTAU\TAU\Module\Administration\Module\Domain\ModuleRepository', $moduleRepository);
        $moduleRepository->clear();

        RoleService::create(1, 'Test', 'Dummy');
        ModuleService::create(1, 'Test', 'Dummy');

        RoleService::addModuleToRole(1,1);
        $this->assertTrue(true);
    }

    /**
     * @dataProvider roleModuleRepositoriesProvider
     */
    public function testServiceCanGetModulesFromRole($entityManager, $roleRepository, $moduleRepository)
    {
        $this->resetCommandBus($entityManager);
        app()->add('ProyectoTAU\TAU\Module\Administration\Role\Domain\RoleRepository', $roleRepository);
        $roleRepository->clear();
        app()->add('ProyectoTAU\TAU\Module\Administration\Module\Domain\ModuleRepository', $moduleRepository);
        $moduleRepository->clear();

        RoleService::create(1, 'Test', 'Dummy');
        ModuleService::create(1, 'Test', 'Dummy');
        RoleService::addModuleToRole(1,1);

        RoleService::getModulesFromRole(1);
        $this->assertTrue(true);
    }

    /**
     * @dataProvider roleModuleRepositoriesProvider
     */
    public function testServiceCanRemoveModuleFromRole($entityManager, $roleRepository, $moduleRepository)
    {
        $this->resetCommandBus($entityManager);
        app()->add('ProyectoTAU\TAU\Module\Administration\Role\Domain\RoleRepository', $roleRepository);
        $roleRepository->clear();
        app()->add('ProyectoTAU\TAU\Module\Administration\Module\Domain\ModuleRepository', $moduleRepository);
        $moduleRepository->clear();

        RoleService::create(1, 'Test', 'Dummy');
        ModuleService::create(1, 'Test', 'Dummy');
        RoleService::addModuleToRole(1,1);
        RoleService::getModulesFromRole(1);

        RoleService::removeModuleFromRole(1,1);
        $this->assertTrue(true);
    }
}
