<?php

namespace ProyectoTAU\TAU\Module\Administration\Group\Domain;

trait GroupUseCases
{
    private $members = [];
    private $authorizedBy = [];

    public function addUser($user)
    {
        $this->members[] = $user;
        // TODO: Raise AddUserToGroupDomainEvent($user, $this)
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
