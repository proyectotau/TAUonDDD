<?php

namespace ProyectoTAU\Tests\Module\Administration\Module\Application;

use PHPUnit\Framework\TestCase;
use ProyectoTAU\TAU\Common\AssertsArraySubset;
use ProyectoTAU\TAU\Module\Administration\Role\Domain\Role;
use ProyectoTAU\TAU\Module\Administration\Module\Domain\Module;
use ProyectoTAU\TAU\Module\Administration\Role\Application\addModuleToRole\AddModuleToRoleCommand;
use ProyectoTAU\TAU\Module\Administration\Role\Application\addModuleToRole\AddModuleToRoleCommandHandler;
use ProyectoTAU\TAU\Module\Administration\Role\Application\removeModuleFromRole\RemoveModuleFromRoleCommand;
use ProyectoTAU\TAU\Module\Administration\Role\Application\removeModuleFromRole\RemoveModuleFromRoleCommandHandler;
use ProyectoTAU\TAU\Module\Administration\Role\Application\getModulesFromRole\GetModulesFromRoleCommand;
use ProyectoTAU\TAU\Module\Administration\Role\Application\getModulesFromRole\GetModulesFromRoleCommandHandler;
use ProyectoTAU\TAU\Module\Administration\Role\Application\RoleService;

class ModuleRoleRelationTest extends TestCase
{
    use AssertsArraySubset;

    public function testItCanAddModuleToRole()
    {
        $roleRepository = app()->get('ProyectoTAU\TAU\Module\Administration\Role\Domain\RoleRepository');
        $roleRepository->clear();
        $moduleRepository = app()->get('ProyectoTAU\TAU\Module\Administration\Module\Domain\ModuleRepository');
        $moduleRepository->clear();

        $roleRepository->create($role = new Role(0, "Test", "Dummy"));
        $moduleRepository->create($module = new Module(0, "Test", "Dummy"));

        //RoleService::addModuleToRole(0,0);

        $handle = new AddModuleToRoleCommandHandler($moduleRepository, $roleRepository);
        $handle->handle(new AddModuleToRoleCommand(0,0));

        $actual = $roleRepository->getModulesFromRole($role);

        $expected = [
            'canrun' => [
                $module
            ],
            'available' => []
        ];
        $message = '';
        $result = $this->AssertsArrayIsASubsetOf($expected, $actual, $message);
        $this->assertTrue($result, $message);
    }

    public function testItCanGetModulesFromRole()
    {
        $roleRepository = app()->get('ProyectoTAU\TAU\Module\Administration\Role\Domain\RoleRepository');
        $roleRepository->clear();
        $moduleRepository = app()->get('ProyectoTAU\TAU\Module\Administration\Module\Domain\ModuleRepository');
        $moduleRepository->clear();

        $roleRepository->create($role = new Role(0, "Test", "Dummy"));
        $moduleRepository->create($module = new Module(0, "Test", "Dummy"));

        $roleRepository->addModuleToRole($module, $role);

        //RoleService::addModuleToRole(0,0);

        $handler = new GetModulesFromRoleCommandHandler($roleRepository);
        $actual = $handler->handle(new GetModulesFromRoleCommand(0));

        $expected = [
            'canrun' => [
                $module
            ],
            'available' => []
        ];
        $message = '';
        $result = $this->AssertsArrayIsASubsetOf($expected, $actual, $message);
        $this->assertTrue($result, $message);
    }

    public function testItCanRemoveModuleFromRole()
    {
        $roleRepository = app()->get('ProyectoTAU\TAU\Module\Administration\Role\Domain\RoleRepository');
        $roleRepository->clear();
        $moduleRepository = app()->get('ProyectoTAU\TAU\Module\Administration\Module\Domain\ModuleRepository');
        $moduleRepository->clear();

        $moduleRepository->create($module = new Module(0, "Test0", "Dummy", "fakelogin"));
        $roleRepository->create($role = new Role(0, "Test", "Dummy"));

        $roleRepository->addModuleToRole($module, $role);

        //RoleService::removeModuleFromRole(0, 0);

        $handler = new RemoveModuleFromRoleCommandHandler($moduleRepository, $roleRepository);
        $handler->handle(new RemoveModuleFromRoleCommand(0, 0));

        $actual = $roleRepository->getModulesFromRole($role);

        $expected = [
            'canrun' => [
            ],
            'available' => [
                $module
            ]
        ];
        $message = '';
        $result = $this->AssertsArrayIsASubsetOf($expected, $actual, $message);
        $this->assertTrue($result, $message);
    }
}
