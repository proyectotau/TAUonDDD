<?php

namespace ProyectoTAU\TAU\Module\Administration\Module\Infrastructure;

use ProyectoTAU\TAU\Common\SQLiteRepository;
use ProyectoTAU\TAU\Module\Administration\Group\Domain\Group;
use ProyectoTAU\TAU\Module\Administration\Module\Domain\ModuleRepository;
use ProyectoTAU\TAU\Module\Administration\Module\Domain\Module;
use ProyectoTAU\TAU\Module\Administration\Role\Domain\Role;

class SQLiteModuleRepository implements ModuleRepository
{
    public function clear(): void
    {
        SQLiteRepository::getInstance()->clearModule();
    }

    public function create(Module $module): void
    {
        SQLiteRepository::getInstance()->createModule($module);
    }

    public function read($id): Module
    {
        return SQLiteRepository::getInstance()->readModule($id);
    }

    public function update($id, $name, $desc): void
    {
        SQLiteRepository::getInstance()->updateModule($id, $name, $desc);
    }

    public function delete($id): void
    {
        SQLiteRepository::getInstance()->deleteModule($id);
    }

    public function addRoleToModule(Role $role, Module $module): void
    {
        SQLiteRepository::getInstance()->addRoleToModule($role, $module);
    }

    public function removeRoleFromModule(Role $role, Module $module): void
    {
        SQLiteRepository::getInstance()->removeRoleFromModule($role, $module);
    }

    public function getRolesFromModule(Module $module): array
    {
        return SQLiteRepository::getInstance()->getRolesFromModule($module);
    }
}
