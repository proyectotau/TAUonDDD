<?php

namespace ProyectoTAU\TAU\Module\Administration\Group\Domain;

use ProyectoTAU\TAU\Module\Administration\Role\Domain\Role;

trait GroupUseCases
{
    private $members = [];
    private $plays = [];

    public function addUser($user)
    {
        $this->members[$user->getId()] = $user; // TODO: use ID in other relations !!!
        // TODO: Raise AddUserToGroupDomainEvent($user, $this)
        //$user->addGroup($this); //TODO: this causes an infinite loop
    }

    public function removeUser($user)
    {
        unset($this->members[$user->getId()]);
        // TODO: Raise RemoveUserToGroupDomainEvent($user, $this)
    }

    public function getUsers(): array
    {
        return $this->members;
    }

    public function addRole($role)
    {
        $this->plays[$role->getId()] = $role;
        // TODO: Raise AddRoleToGroupDomainEvent($role, $this)
    }

    public function removeRole(Role $role)
    {
        unset($this->plays[$role->getId()]);
        // TODO: Raise RemoveRoleFromGroupDomainEvent($role, $this)
    }

    public function getRoles()
    {
        return $this->plays;
    }
}
