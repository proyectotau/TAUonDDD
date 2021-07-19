<?php

namespace ProyectoTAU\TAU\Module\Administration\User\Domain;

interface UserRepository
{
    public function create(User $user): void;
    public function read($id): User;
    public function update($id, $name, $surname, $login): void;
    public function delete($id): void;

    public function addGroupToUser($group, $user);
}
