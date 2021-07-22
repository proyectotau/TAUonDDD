<?php

namespace ProyectoTAU\TAU\Module\Administration\Module\Domain;

use ProyectoTAU\TAU\Module\Administration\Role\Domain\Role;

interface ModuleRepository
{
    public function create(Module $module): void;
    public function read($id): Module;
    public function update($id, $name, $desc): void;
    public function delete($id): void;

    public function addRoleToModule(Role $role, Module $module);
    public function getRolesFromModule(Module $module): array;
}