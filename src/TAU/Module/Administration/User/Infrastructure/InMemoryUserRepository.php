<?php

namespace ProyectoTAU\TAU\Module\Administration\User\Infrastructure;

use ProyectoTAU\TAU\Module\Administration\User\Domain\User;
use ProyectoTAU\TAU\Module\Administration\User\Domain\UserRepository;

class InMemoryUserRepository implements UserRepository
{
    private $userDataStore = [];

    public function create(User $user): void
    {
        $this->userDataStore[$user->getId()] = $user;
    }

    public function read($id): User
    {
        return $this->userDataStore[$id];
    }

    public function update($id, $name, $surname, $login): void
    {
        $this->userDataStore[$id]->setName($name);
        $this->userDataStore[$id]->setName($surname);
        $this->userDataStore[$id]->setName($login);
    }

    public function delete($id): void
    {
        unset($this->userDataStore[$id]);
    }
}
