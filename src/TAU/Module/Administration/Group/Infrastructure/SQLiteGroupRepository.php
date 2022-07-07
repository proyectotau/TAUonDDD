<?php

namespace ProyectoTAU\TAU\Module\Administration\Group\Infrastructure;

use ProyectoTAU\TAU\Common\SQLiteRepository;
use ProyectoTAU\TAU\Module\Administration\Role\Domain\Role;
use ProyectoTAU\TAU\Module\Administration\User\Domain\User;
use ProyectoTAU\TAU\Module\Administration\Group\Domain\Group;
use ProyectoTAU\TAU\Module\Administration\Group\Domain\GroupRepository;

class SQLiteGroupRepository implements GroupRepository
{
    public function clear(): void
    {
        SQLiteRepository::getInstance()->clearGroup();
    }

    public function create(Group $group): void
    {
        SQLiteRepository::getInstance()->createGroup($group);
    }

    public function read($id): Group
    {
        return SQLiteRepository::getInstance()->readGroup($id);
    }

    public function readAll(): array
    {
        return SQLiteRepository::getInstance()->readAllGroups();
    }

    public function update($id, $name, $desc): void
    {
        SQLiteRepository::getInstance()->updateGroup($id, $name, $desc);
    }

    public function delete($id): void
    {
        SQLiteRepository::getInstance()->deleteGroup($id);
    }

    public function addUserToGroup($user, $group): void
    {
        SQLiteRepository::getInstance()->addUserToGroup($user, $group);
    }

    public function addRoleToGroup(Role $role, Group $group): void
    {
        SQLiteRepository::getInstance()->addRoleToGroup($role, $group);
    }

    public function removeUserFromGroup(User $user, Group $group): void
    {
        SQLiteRepository::getInstance()->removeUserFromGroup($user, $group);
    }

    public function removeRoleFromGroup(Role $roleId, Group $groupId): void
    {
        SQLiteRepository::getInstance()->removeRoleFromGroup($roleId, $groupId);
    }

    public function getUsersFromGroup(Group $group): array
    {
        return SQLiteRepository::getInstance()->getUsersFromGroup($group);
    }

    public function getRolesFromGroup(Group $group): array
    {
        return SQLiteRepository::getInstance()->getRolesFromGroup($group);
    }
}
