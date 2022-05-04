<?php

namespace ProyectoTAU\TAU\Module\Administration\Role\Infrastructure;

use ProyectoTAU\TAU\Common\SQLiteRepository;
use ProyectoTAU\TAU\Module\Administration\Module\Domain\Module;
use ProyectoTAU\TAU\Module\Administration\Role\Domain\Role;
use ProyectoTAU\TAU\Module\Administration\Group\Domain\Group;
use ProyectoTAU\TAU\Module\Administration\Role\Domain\RoleRepository;

class SQLiteRoleRepository implements RoleRepository
{
    public function clear(): void
    {
        SQLiteRepository::getInstance()->clearRole();
    }

    public function create(Role $role): void
    {
        SQLiteRepository::getInstance()->createRole($role);
    }

    public function read($id): Role
    {
        return SQLiteRepository::getInstance()->readRole($id);
    }

    public function update($id, $name, $desc): void
    {
        SQLiteRepository::getInstance()->updateRole($id, $name, $desc);
    }

    public function delete($id): void
    {
        SQLiteRepository::getInstance()->deleteRole($id);
    }

    public function addGroupToRole(Group $group, Role $role): void
    {
        SQLiteRepository::getInstance()->addGroupToRole($group, $role);
    }

    public function removeGroupFromRole(Group $group, Role $role): void
    {
        SQLiteRepository::getInstance()->removeGroupFromRole($group, $role);
    }

    public function getGroupsFromRole(Role $role): array
    {
        return SQLiteRepository::getInstance()->getGroupsFromRole($role);
    }

    public function addRoleToGroup($role, $group): void
    {
        SQLiteRepository::getInstance()->addRoleToGroup($role, $group);
    }

    public function removeRoleFromGroup(Role $role, Group $group): void
    {
        SQLiteRepository::getInstance()->removeRoleFromGroup($role, $group);
    }

    public function addModuleToRole(Module $module, Role $role): void
    {
        SQLiteRepository::getInstance()->addModuleToRole($module, $role);
    }

    public function removeModuleFromRole(Module $module, Role $role): void
    {
        SQLiteRepository::getInstance()->removeModuleFromRole($module, $role);
    }

    public function getModulesFromRole(Role $role): array
    {
        return SQLiteRepository::getInstance()->getModulesFromRole($role);
    }
}
