<?php

namespace Tests\Module\Administration\Module\Application;

use PHPUnit\Framework\TestCase;
use ProyectoTAU\TAU\Common\InMemoryRepository;
use ProyectoTAU\TAU\Module\Administration\Module\Application\addRoleToModule\AddRoleToModule;
use ProyectoTAU\TAU\Module\Administration\Module\Application\getRolesFromModule\GetRolesFromModule;
use ProyectoTAU\TAU\Module\Administration\Module\Infrastructure\InMemoryModuleRepository;
use ProyectoTAU\TAU\Module\Administration\Role\Infrastructure\InMemoryRoleRepository;
use ProyectoTAU\TAU\Module\Administration\Module\Domain\Module;
use ProyectoTAU\TAU\Module\Administration\Role\Domain\Role;

class ModuleRoleRelationTest extends TestCase
{
    public function testItCanAddRoleToModule()
    {
        InMemoryRepository::getInstance()->clear();

        $roleRepository = new InMemoryRoleRepository();
        $groupRepository = new InMemoryModuleRepository();

        $roleRepository->create($role = new Role(0, "Test", "Dummy"));
        $groupRepository->create($group = new Module(0, "Test", "Dummy"));

        $addRoleToModuleService = new AddRoleToModule($roleRepository, $groupRepository);
        $addRoleToModuleService->addRoleToModule(0, 0);

        $actual = InMemoryRepository::getInstance()->getRolesFromModule($group);

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
        $groupRepository = new InMemoryModuleRepository();

        $roleRepository->create($role = new Role(0, "Test", "Dummy"));
        $groupRepository->create($group = new Module(0, "Test", "Dummy"));

        InMemoryRepository::getInstance()->addRoleToModule($role, $group);

        $getRolesFromModuleService = new GetRolesFromModule($groupRepository);
        $actual = $getRolesFromModuleService->getRolesFromModule(0);

        $this->assertSame([
            'grantedBy' => [
                $role
            ],
            'available' => []
        ], $actual);
    }
}
