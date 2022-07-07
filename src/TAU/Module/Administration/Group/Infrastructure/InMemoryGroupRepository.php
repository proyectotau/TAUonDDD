<?php

namespace ProyectoTAU\TAU\Module\Administration\Group\Infrastructure;

use ProyectoTAU\TAU\Common\InMemoryRepository;
use ProyectoTAU\TAU\Module\Administration\User\Domain\User;
use ProyectoTAU\TAU\Module\Administration\Group\Domain\Group;
use ProyectoTAU\TAU\Module\Administration\Role\Domain\Role;
use ProyectoTAU\TAU\Module\Administration\Group\Domain\GroupRepository;

class InMemoryGroupRepository implements GroupRepository
{
    public function clear(): void
    {
        InMemoryRepository::getInstance()->clearGroup();
    }

    public function create(Group $group): void
    {
        InMemoryRepository::getInstance()->createGroup(clone $group);
    }

    public function read($id): Group
    {
        return InMemoryRepository::getInstance()->readGroup($id);
    }

    public function readAll(): array
    {
        return InMemoryRepository::getInstance()->readAllGroups();
    }

    public function update($id, $name, $desc): void
    {
        InMemoryRepository::getInstance()->updateGroup($id, $name, $desc);
    }

    public function delete($id): void
    {
        InMemoryRepository::getInstance()->deleteGroup($id);
    }

    public function addUserToGroup(User $user, Group $group): void
    {
        InMemoryRepository::getInstance()->addUserToGroup($user, $group);
    }

    public function removeUserFromGroup(User $user, Group $group): void
    {
        InMemoryRepository::getInstance()->removeUserFromGroup($user, $group);
    }

    public function getUsersFromGroup(Group $group): array
    {
        return InMemoryRepository::getInstance()->getUsersFromGroup($group);
    }

    public function addRoleToGroup(Role $role, Group $group): void
    {
        InMemoryRepository::getInstance()->addRoleToGroup($role, $group);
    }

    public function removeRoleFromGroup(Role $role, Group $group): void
    {
        InMemoryRepository::getInstance()->removeRoleFromGroup($role, $group);
    }

    public function getRolesFromGroup(Group $group): array
    {
        return InMemoryRepository::getInstance()->getRolesFromGroup($group);
    }
}
