<?php

namespace ProyectoTAU\TAU\Module\Administration\Role\Domain;

use ProyectoTAU\TAU\Module\Administration\Group\Domain\Group;
use ProyectoTAU\TAU\Module\Administration\Module\Domain\Module;

interface RoleRepository
{
    public function create(Role $role): void;
    public function read($id): Role;
    public function update($id, $name, $desc): void;
    public function delete($id): void;
    public function addGroupToRole(Group $group, Role $role);
    public function addModuleToRole(Module $module, Role $role);
}
