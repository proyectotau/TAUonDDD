<?php

namespace ProyectoTAU\TAU\Module\Administration\User\Infrastructure;

use ProyectoTAU\TAU\Common\InMemoryRepository;
use ProyectoTAU\TAU\Module\Administration\User\Domain\User;
use ProyectoTAU\TAU\Module\Administration\User\Domain\UserRepository;

class InMemoryUserRepository implements UserRepository
{
    public function create(User $user): void
    {
        InMemoryRepository::getInstance()->createUser($user);
    }

    public function read($id): User
    {
        return InMemoryRepository::getInstance()->readUser($id);
    }

    public function update($id, $name, $surname, $login): void
    {
        InMemoryRepository::getInstance()->updateUser($id, $name, $surname, $login);
    }

    public function delete($id): void
    {
        InMemoryRepository::getInstance()->deleteUser($id);
    }
}