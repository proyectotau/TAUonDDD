<?php

namespace ProyectoTAU\TAU\Module\Administration\Group\Domain;

trait GroupUseCases
{
    private $members = [];
    private $authorizedBy = [];

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
        $this->authorizedBy[] = $role;
        // TODO: Raise AddRoleToGroupDomainEvent($role, $this)
    }

    public function getRoles()
    {
        return $this->authorizedBy;
    }
}
