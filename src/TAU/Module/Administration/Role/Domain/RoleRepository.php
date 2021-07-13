<?php

namespace ProyectoTAU\TAU\Module\Administration\Role\Domain;

interface RoleRepository
{
    public function create(Role $role): void;
    public function read($id): Role;
    public function update($id, $name, $desc): void;
    public function delete($id): void;
}
