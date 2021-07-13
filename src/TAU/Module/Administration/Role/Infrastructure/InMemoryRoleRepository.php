<?php

namespace ProyectoTAU\TAU\Module\Administration\Role\Infrastructure;

use ProyectoTAU\TAU\Module\Administration\Role\Domain\Role;
use ProyectoTAU\TAU\Module\Administration\Role\Domain\RoleRepository;

class InMemoryRoleRepository implements RoleRepository
{
    private $roleDataStore = [];

    public function create(Role $role): void
    {
        $this->roleDataStore[$role->getId()] = $role;
    }

    public function read($id): Role
    {
        return $this->roleDataStore[$id];
    }

    public function update($id, $name, $desc): void
    {
        $this->roleDataStore[$id]->setName($name);
        $this->roleDataStore[$id]->setName($desc);
    }

    public function delete($id): void
    {
        unset($this->roleDataStore[$id]);
    }
}
