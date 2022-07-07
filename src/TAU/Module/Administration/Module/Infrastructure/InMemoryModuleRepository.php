<?php

namespace ProyectoTAU\TAU\Module\Administration\Module\Infrastructure;

use ProyectoTAU\TAU\Common\InMemoryRepository;
use ProyectoTAU\TAU\Module\Administration\Role\Domain\Role;
use ProyectoTAU\TAU\Module\Administration\Module\Domain\Module;
use ProyectoTAU\TAU\Module\Administration\Module\Domain\ModuleRepository;

class InMemoryModuleRepository implements ModuleRepository
{
    public function clear(): void
    {
        InMemoryRepository::getInstance()->clearModule();
    }

    public function create(Module $module): void
    {
        InMemoryRepository::getInstance()->createModule(clone $module);
    }

    public function read($id): Module
    {
        return InMemoryRepository::getInstance()->readModule($id);
    }

    public function readAll(): array
    {
        return InMemoryRepository::getInstance()->readAllModules();
    }

    public function update($id, $name, $desc): void
    {
        InMemoryRepository::getInstance()->updateModule($id, $name, $desc);
    }

    public function delete($id): void
    {
        InMemoryRepository::getInstance()->deleteModule($id);
    }

    public function addRoleToModule(Role $role, Module $module): void
    {
        InMemoryRepository::getInstance()->addRoleToModule($role, $module);
    }

    public function removeRoleFromModule(Role $role, Module $module): void
    {
        InMemoryRepository::getInstance()->removeRoleFromModule($role, $module);
    }

    public function getRolesFromModule(Module $module): array
    {
        return InMemoryRepository::getInstance()->getRolesFromModule($module);
    }
}
