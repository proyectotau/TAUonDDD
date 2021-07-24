<?php

namespace ProyectoTAU\TAU\Module\Administration\Module\Domain;

trait ModuleUseCases
{
    private $roles = [];

    public function addRole($role)
    {
        $this->roles[] = $role;
        // TODO: Raise AddRoleToModuleDomainEvent($role, $this)
    }

    public function getRoles(): array
    {
        return $this->roles;
    }
}
