<?php

namespace ProyectoTAU\TAU\Module\Administration\Role\Infrastructure;

use ProyectoTAU\TAU\Common\InMemoryRepository;
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
}
