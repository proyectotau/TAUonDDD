<?php

namespace ProyectoTAU\TAU\Module\Administration\Role\Domain;

use ProyectoTAU\TAU\Module\Administration\Group\Domain\Group;
use ProyectoTAU\TAU\Module\Administration\Module\Domain\Module;

interface RoleRepository
{
    public function clear(): void;

    public function create(Role $role): void;
    public function read($id): Role;
    public function update($id, $name, $desc): void;
    public function delete($id): void;

    public function addGroupToRole(Group $group, Role $role): void;
    public function removeGroupFromRole(Group $group, Role $role): void;
    public function addModuleToRole(Module $module, Role $role): void;
    public function removeModuleFromRole(Module $module, Role $role): void;
    public function getGroupsFromRole(Role $role): array;
    public function getModulesFromRole(Role $role): array;


}
