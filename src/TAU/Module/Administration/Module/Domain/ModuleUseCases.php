<?php

namespace ProyectoTAU\TAU\Module\Administration\Module\Domain;

use ProyectoTAU\TAU\Module\Administration\Role\Domain\Role;

trait ModuleUseCases
{
    private $roles = [];

    public function addRole($role)
    {
        $this->roles[$role->getId()] = $role;
        // TODO: Raise AddRoleToModuleDomainEvent($role, $this)
    }

    public function removeRole(Role $role)
    {
        unset($this->roles[$role->getId()]);
        // TODO: Raise RemoveRoleFromModuleDomainEvent($role, $this)
    }

    public function getRoles(): array
    {
        return $this->roles;
    }
}
