<?php

namespace ProyectoTAU\TAU\Module\Administration\User\Infrastructure;

use ProyectoTAU\TAU\Common\InMemoryRepository;
use ProyectoTAU\TAU\Module\Administration\User\Domain\User;
use ProyectoTAU\TAU\Module\Administration\Group\Domain\Group;
use ProyectoTAU\TAU\Module\Administration\User\Domain\UserRepository;

class InMemoryUserRepository implements UserRepository
{
    public function clear(): void
    {
        InMemoryRepository::getInstance()->clearUser();
    }

    public function create(User $user): void
    {
        InMemoryRepository::getInstance()->createUser(clone $user);
    }

    public function read($id): User
    {
        return InMemoryRepository::getInstance()->readUser($id);
    }

    public function readAll(): array
    {
        return InMemoryRepository::getInstance()->readAllUsers();
    }

    public function update($id, $name, $surname, $login): void
    {
        InMemoryRepository::getInstance()->updateUser($id, $name, $surname, $login);
    }

    public function delete($id): void
    {
        InMemoryRepository::getInstance()->deleteUser($id);
    }

    public function addGroupToUser(Group $group, User $user): void
    {
        InMemoryRepository::getInstance()->addGroupToUser($group, $user);
    }

    public function removeGroupFromUser(Group $group, User $user): void
    {
        InMemoryRepository::getInstance()->removeGroupFromUser($group, $user);
    }

    public function getGroupsFromUser(User $user): array
    {
        return InMemoryRepository::getInstance()->getGroupsFromUser($user);
    }
}
