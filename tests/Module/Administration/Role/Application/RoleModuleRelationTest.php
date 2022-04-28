<?php

namespace ProyectoTAU\Tests\Module\Administration\Role\Application;

use PHPUnit\Framework\TestCase;
use ProyectoTAU\TAU\Common\AssertsArraySubset;
use ProyectoTAU\TAU\Module\Administration\Role\Domain\Role;
use ProyectoTAU\TAU\Module\Administration\Module\Domain\Module;
use ProyectoTAU\TAU\Module\Administration\Module\Application\addRoleToModule\AddRoleToModuleCommand;
use ProyectoTAU\TAU\Module\Administration\Module\Application\addRoleToModule\AddRoleToModuleCommandHandler;
use ProyectoTAU\TAU\Module\Administration\Module\Application\getRolesFromModule\GetRolesFromModuleCommand;
use ProyectoTAU\TAU\Module\Administration\Module\Application\getRolesFromModule\GetRolesFromModuleCommandHandler;
use ProyectoTAU\TAU\Module\Administration\Module\Application\removeRoleFromModule\RemoveRoleFromModuleCommand;
use ProyectoTAU\TAU\Module\Administration\Module\Application\removeRoleFromModule\RemoveRoleFromModuleCommandHandler;
use ProyectoTAU\TAU\Module\Administration\Module\Application\ModuleService;


class RoleModuleRelationTest extends TestCase
{
    use AssertsArraySubset;

    public function testItCanAddRoleToModule()
    {
        $roleRepository = app()->get('ProyectoTAU\TAU\Module\Administration\Role\Domain\RoleRepository');
        $roleRepository->clear();
        $moduleRepository = app()->get('ProyectoTAU\TAU\Module\Administration\Module\Domain\ModuleRepository');
        $moduleRepository->clear();

        $roleRepository->create($role = new Role(0, "Test", "Dummy"));
        $moduleRepository->create($module = new Module(0, "Test", "Dummy"));

        //ModuleService::addRoleToModule(0, 0);

        $handler = new AddRoleToModuleCommandHandler($roleRepository, $moduleRepository);
        $handler->handle(new AddRoleToModuleCommand(0,0));

        $actual = $moduleRepository->getRolesFromModule($module);

        $expected = [
            'authorizedby' => [
                $role
            ],
            'available' => []
        ];
        $message = '';
        $result = $this->AssertsArrayIsASubsetOf($expected, $actual, $message);
        $this->assertTrue($result, $message);
    }

    public function testItCanGetRolesFromModule()
    {
        $roleRepository = app()->get('ProyectoTAU\TAU\Module\Administration\Role\Domain\RoleRepository');
        $roleRepository->clear();
        $moduleRepository = app()->get('ProyectoTAU\TAU\Module\Administration\Module\Domain\ModuleRepository');
        $moduleRepository->clear();

        $roleRepository->create($role = new Role(0, "Test", "Dummy"));
        $moduleRepository->create($module = new Module(0, "Test", "Dummy"));

        $moduleRepository->addRoleToModule($role, $module);

        //$actual = ModuleService::getRolesFromModule(0);

        $handler = new GetRolesFromModuleCommandHandler($moduleRepository);
        $actual = $handler->handle(new GetRolesFromModuleCommand(0));

        $expected = [
            'authorizedby' => [
                $role
            ],
            'available' => []
        ];
        $message = '';
        $result = $this->AssertsArrayIsASubsetOf($expected, $actual, $message);
        $this->assertTrue($result, $message);
    }

    public function testItCanRemoveRoleFromModule()
    {
        $roleRepository = app()->get('ProyectoTAU\TAU\Module\Administration\Role\Domain\RoleRepository');
        $roleRepository->clear();
        $moduleRepository = app()->get('ProyectoTAU\TAU\Module\Administration\Module\Domain\ModuleRepository');
        $moduleRepository->clear();

        $roleRepository->create($role = new Role(0, "Test", "Dummy", "fakelogin"));
        $moduleRepository->create($module = new Module(0, "Test", "Dummy"));

        $moduleRepository->addRoleToModule($role, $module);

        //ModuleService::removeRoleFromModule(0, 0);

        $handler = new RemoveRoleFromModuleCommandHandler($roleRepository,$moduleRepository);
        $handler->handle(new RemoveRoleFromModuleCommand(0, 0));

        $actual = $moduleRepository->getRolesFromModule($module);

        $expected = [
            'authorizedby' => [
            ],
            'available' => [
                $role
            ]
        ];
        $message = '';
        $result = $this->AssertsArrayIsASubsetOf($expected, $actual, $message);
        $this->assertTrue($result, $message);
    }
}
