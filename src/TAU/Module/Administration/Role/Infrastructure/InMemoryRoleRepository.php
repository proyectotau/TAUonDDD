<?php

namespace ProyectoTAU\TAU\Module\Administration\Role\Infrastructure;

use ProyectoTAU\TAU\Common\InMemoryRepository;
use ProyectoTAU\TAU\Module\Administration\Group\Domain\Group;
use ProyectoTAU\TAU\Module\Administration\Module\Domain\Module;
use ProyectoTAU\TAU\Module\Administration\Role\Domain\Role;
use ProyectoTAU\TAU\Module\Administration\Role\Domain\RoleRepository;

class InMemoryRoleRepository implements RoleRepository
{
    public function create(Role $role): void
    {
        InMemoryRepository::getInstance()->createRole($role);
    }

    public function read($id): Role
    {
        return InMemoryRepository::getInstance()->readRole($id);
    }

    public function update($id, $name, $desc): void
    {
        InMemoryRepository::getInstance()->updateRole($id, $name, $desc);
    }

    public function delete($id): void
    {
        InMemoryRepository::getInstance()->deleteRole($id);
    }

    public function addGroupToRole(Group $group, Role $role): void
    {
        InMemoryRepository::getInstance()->addGroupToRole($group, $role);
    }

    public function removeGroupFromRole(Group $group, Role $role): void
    {
        InMemoryRepository::getInstance()->removeGroupFromRole($group, $role);
    }

    public function getGroupsFromRole(Role $role): array
    {
        return InMemoryRepository::getInstance()->getGroupsFromRole($role);
    }

    public function addModuleToRole(Module $module, Role $role): void
    {
        InMemoryRepository::getInstance()->addModuleToRole($module, $role);
    }

    public function removeModuleFromRole(Module $module, Role $role): void
    {
        InMemoryRepository::getInstance()->removeModuleFromRole($module, $role);
    }

    public function getModulesFromRole(Role $role): array
    {
        return InMemoryRepository::getInstance()->getModulesFromRole($role);
    }
}
