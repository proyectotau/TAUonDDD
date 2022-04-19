<?php

namespace ProyectoTAU\Tests\Module\Administration\Module\Application;

use PHPUnit\Framework\TestCase;
use ProyectoTAU\TAU\Common\InMemoryRepository;
use ProyectoTAU\TAU\Module\Administration\Role\Infrastructure\InMemoryRoleRepository;
use ProyectoTAU\TAU\Module\Administration\Module\Infrastructure\InMemoryModuleRepository;
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
    public function testItCanAddModuleToRole()
    {
        InMemoryRepository::getInstance()->clear();

        $roleRepository = new InMemoryRoleRepository();
        $moduleRepository = new InMemoryModuleRepository();

        $roleRepository->create($role = new Role(0, "Test", "Dummy"));
        $moduleRepository->create($module = new Module(0, "Test", "Dummy"));

        //RoleService::addModuleToRole(0,0);

        $handle = new AddModuleToRoleCommandHandler($moduleRepository, $roleRepository);
        $handle->handle(new AddModuleToRoleCommand(0,0));

        $actual = InMemoryRepository::getInstance()->getModulesFromRole($role);

        $this->assertSame([
            'canrun' => [
                $module
            ],
            'available' => []
        ], $actual);
    }

    public function testItCanGetModulesFromRole()
    {
        InMemoryRepository::getInstance()->clear();

        $roleRepository = new InMemoryRoleRepository();
        $moduleRepository = new InMemoryModuleRepository();

        $roleRepository->create($role = new Role(0, "Test", "Dummy"));
        $moduleRepository->create($module = new Module(0, "Test", "Dummy"));

        InMemoryRepository::getInstance()->addModuleToRole($module, $role);

        //RoleService::addModuleToRole(0,0);

        $handler = new GetModulesFromRoleCommandHandler($roleRepository);
        $actual = $handler->handle(new GetModulesFromRoleCommand(0));

        $this->assertSame([
            'canrun' => [
                $module
            ],
            'available' => []
        ], $actual);
    }

    public function testItCanRemoveModuleFromRole()
    {
        InMemoryRepository::getInstance()->clear();

        $roleRepository = new InMemoryRoleRepository();
        $moduleRepository = new InMemoryModuleRepository();

        $moduleRepository->create($module = new Module(0, "Test0", "Dummy", "fakelogin"));
        $roleRepository->create($role = new Role(0, "Test", "Dummy"));

        InMemoryRepository::getInstance()->addModuleToRole($module, $role);

        //RoleService::removeModuleFromRole(0, 0);

        $handler = new RemoveModuleFromRoleCommandHandler($moduleRepository, $roleRepository);
        $handler->handle(new RemoveModuleFromRoleCommand(0, 0));

        $actual = InMemoryRepository::getInstance()->getModulesFromRole($role);

        $this->assertSame([
            'canrun' => [
            ],
            'available' => [
                $module
            ]
        ], $actual);
    }
}
