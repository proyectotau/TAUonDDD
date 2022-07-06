<?php

namespace ProyectoTAU\TAU\Module\Administration\User\Infrastructure;

use ProyectoTAU\TAU\Common\SQLiteRepository;
use ProyectoTAU\TAU\Module\Administration\User\Domain\User;
use ProyectoTAU\TAU\Module\Administration\Group\Domain\Group;
use ProyectoTAU\TAU\Module\Administration\User\Domain\UserRepository;

class SQLiteUserRepository implements UserRepository
{
    public function clear(): void
    {
        SQLiteRepository::getInstance()->clearUser();
    }

    public function create(User $user): void
    {
        SQLiteRepository::getInstance()->createUser($user);
    }

    public function read($id): User
    {
        return SQLiteRepository::getInstance()->readUser($id);
    }

    public function readAll(): array
    {
        return SQLiteRepository::getInstance()->readAllUsers();
    }

    public function update($id, $name, $surname, $login): void
    {
        SQLiteRepository::getInstance()->updateUser($id, $name, $surname, $login);
    }

    public function delete($id): void
    {
        SQLiteRepository::getInstance()->deleteUser($id);
    }

    public function addGroupToUser($group, $user): void
    {
        SQLiteRepository::getInstance()->addGroupToUser($group, $user);
    }

    public function removeGroupFromUser(Group $group, User $user): void
    {
        SQLiteRepository::getInstance()->removeGroupFromUser($group, $user);
    }

    public function getGroupsFromUser(User $user): array
    {
        return SQLiteRepository::getInstance()->getGroupsFromUser($user);
    }
}
