<?php

namespace Tests\Module\Administration\Role\Application;

//use PHPUnit\Framework\TestCase;
use Tests\OrchestratedTestCase as TestCase;
use ProyectoTAU\TAU\Common\InMemoryRepository;
use ProyectoTAU\TAU\Module\Administration\Role\Infrastructure\InMemoryRoleRepository;
use ProyectoTAU\TAU\Module\Administration\Module\Infrastructure\InMemoryModuleRepository;
use ProyectoTAU\TAU\Module\Administration\Role\Application\addModuleToRole\AddModuleToRole;
use ProyectoTAU\TAU\Module\Administration\Module\Application\getRolesFromModule\GetRolesFromModule;
use ProyectoTAU\TAU\Module\Administration\Module\Domain\Module;
use ProyectoTAU\TAU\Module\Administration\Role\Domain\Role;

class RoleModuleRelationTest extends TestCase
{
    public function testItCanAddModuleToRole()
    {
        InMemoryRepository::getInstance()->clear();

        $roleRepository = new InMemoryRoleRepository();
        $moduleRepository = new InMemoryModuleRepository();

        $roleRepository->create($role = new Role(0, "Test", "Dummy"));
        $moduleRepository->create($module = new Module(0, "Test", "Dummy"));

        $addModuleToRoleService = new AddModuleToRole($moduleRepository, $roleRepository);
        $addModuleToRoleService->addModuleToRole(0, 0);

        $actual = InMemoryRepository::getInstance()->getRolesFromModule($module);

        $this->assertSame([
            'grantedBy' => [
                $role
            ],
            'available' => []
        ], $actual);
    }

    public function testItCanGetRolesFromModule()
    {
        InMemoryRepository::getInstance()->clear();

        $roleRepository = new InMemoryRoleRepository();
        $moduleRepository = new InMemoryModuleRepository();

        $roleRepository->create($role = new Role(0, "Test", "Dummy"));
        $moduleRepository->create($module = new Module(0, "Test", "Dummy"));

        InMemoryRepository::getInstance()->addModuleToRole($module, $role);

        $getRolesFromModuleService = new GetRolesFromModule($moduleRepository);
        $actual = $getRolesFromModuleService->getRolesFromModule(0);

        $this->assertSame([
            'grantedBy' => [
                $role
            ],
            'available' => []
        ], $actual);
    }

    public function testItCanGetAvailableRolesFromModule()
    {
        InMemoryRepository::getInstance()->clear();

        $roleRepository = new InMemoryRoleRepository();
        $moduleRepository = new InMemoryModuleRepository();

        $roleRepository->create($role1 = new Role(1, "Test1", "Dummy1", "fakelogin1"));
        $roleRepository->create($role2 = new Role(2, "Test2", "Dummy2", "fakelogin2"));
        $moduleRepository->create($module = new Module(0, "Test", "Dummy1"));

        InMemoryRepository::getInstance()->addRoleToModule($role1, $module);

        $getRolesFromModuleService = new GetRolesFromModule($moduleRepository);
        $actual = $getRolesFromModuleService->getRolesFromModule(0);

        $this->assertSame([
            'grantedBy' => [
                1 => $role1
            ],
            'available' => [
                2 => $role2
            ]
        ], $actual);
    }
}
