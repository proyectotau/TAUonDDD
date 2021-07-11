<?php

namespace ProyectoTAU\TAU\Module\Administration\User\Domain;

interface UserRepository
{
    public function create($id, $name, $surname, $login): void;
    public function read($id): void;
    public function update($id, $name, $surname, $login): void;
    public function delete($id): void;
}
