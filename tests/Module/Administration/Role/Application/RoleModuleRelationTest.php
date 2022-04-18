<?php

namespace Tests\Module\Administration\Role\Application;

use PHPUnit\Framework\TestCase;
use ProyectoTAU\TAU\Common\InMemoryRepository;
use ProyectoTAU\TAU\Module\Administration\Module\Application\addRoleToModule\AddRoleToModuleCommand;
use ProyectoTAU\TAU\Module\Administration\Module\Application\addRoleToModule\AddRoleToModuleCommandHandler;
use ProyectoTAU\TAU\Module\Administration\Module\Application\getRolesFromModule\GetRolesFromModuleCommand;
use ProyectoTAU\TAU\Module\Administration\Module\Application\getRolesFromModule\GetRolesFromModuleCommandHandler;
use ProyectoTAU\TAU\Module\Administration\Module\Application\ModuleService;
use ProyectoTAU\TAU\Module\Administration\Module\Application\removeRoleFromModule\RemoveRoleFromModuleCommand;
use ProyectoTAU\TAU\Module\Administration\Module\Application\removeRoleFromModule\RemoveRoleFromModuleCommandHandler;
use ProyectoTAU\TAU\Module\Administration\Role\Application\addModuleToRole\AddModuleToRoleCommand;
use ProyectoTAU\TAU\Module\Administration\Role\Application\addModuleToRole\AddModuleToRoleCommandHandler;
use ProyectoTAU\TAU\Module\Administration\Role\Application\RoleService;
use ProyectoTAU\TAU\Module\Administration\Role\Infrastructure\InMemoryRoleRepository;
use ProyectoTAU\TAU\Module\Administration\Module\Infrastructure\InMemoryModuleRepository;
use ProyectoTAU\TAU\Module\Administration\Role\Application\addModuleToRole\AddModuleToRole;
use ProyectoTAU\TAU\Module\Administration\Module\Application\getRolesFromModule\GetRolesFromModule;
use ProyectoTAU\TAU\Module\Administration\Module\Domain\Module;
use ProyectoTAU\TAU\Module\Administration\Role\Domain\Role;

class RoleModuleRelationTest extends TestCase
{
    public function testItCanAddRoleToModule()
    {
        InMemoryRepository::getInstance()->clear();

        $roleRepository = new InMemoryRoleRepository();
        $moduleRepository = new InMemoryModuleRepository();

        $roleRepository->create($role = new Role(0, "Test", "Dummy"));
        $moduleRepository->create($module = new Module(0, "Test", "Dummy"));

        ModuleService::addRoleToModule(0, 0);

        //$handler = new AddRoleToModuleCommandHandler($roleRepository, $moduleRepository);
        //$handler->handle(new AddRoleToModuleCommand(0,0));

        $actual = InMemoryRepository::getInstance()->getRolesFromModule($module);

        $this->assertSame([
            'authorizedby' => [
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

        InMemoryRepository::getInstance()->addRoleToModule($role, $module);

        $actual = ModuleService::getRolesFromModule(0);

        //$handler = new GetRolesFromModuleCommandHandler($moduleRepository);
        //$actual = $handler->handle(new GetRolesFromModuleCommand(0));

        $this->assertSame([
            'authorizedby' => [
                $role
            ],
            'available' => []
        ], $actual);
    }

    public function testItCanRemoveRoleFromModule()
    {
        InMemoryRepository::getInstance()->clear();

        $roleRepository = new InMemoryRoleRepository();
        $moduleRepository = new InMemoryModuleRepository();

        $roleRepository->create($role = new Role(0, "Test", "Dummy", "fakelogin"));
        $moduleRepository->create($module = new Module(0, "Test", "Dummy"));

        InMemoryRepository::getInstance()->addRoleToModule($role, $module);

        ModuleService::removeRoleFromModule(0, 0);

        //$handler = new RemoveRoleFromModuleCommandHandler($roleRepository,$moduleRepository);
        //$handler->handle(new RemoveRoleFromModuleCommand(0, 0));

        $actual = InMemoryRepository::getInstance()->getRolesFromModule($module);

        $this->assertSame([
            'authorizedby' => [
            ],
            'available' => [
                $role
            ]
        ], $actual);
    }
}
