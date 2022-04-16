<?php

namespace ProyectoTAU\TAU\Module\Administration\Group\Domain;

use ProyectoTAU\TAU\Module\Administration\Role\Domain\Role;
use ProyectoTAU\TAU\Module\Administration\User\Domain\User;

interface GroupRepository
{
    public function create(Group $group): void;
    public function read($id): Group;
    public function update($id, $name, $desc): void;
    public function delete($id): void;

    public function addUserToGroup(User $user, Group $group): void;
    public function addRoleToGroup(Role $role, Group $group): void;
    public function removeUserFromGroup(User $user, Group $group): void;
    public function getUsersFromGroup(Group $group): array;
    public function getRolesFromGroup(Group $group): array;
}
