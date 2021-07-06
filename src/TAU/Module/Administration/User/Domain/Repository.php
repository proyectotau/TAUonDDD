<?php

namespace ProyectoTAU\TAU\Module\Administration\User\Domain;

interface Repository
{
    public function save($id, $name, $surname, $login): void;
    public function delete($id): void;
    public function update($id, $name, $surname, $login): void;
    public function read($id): void;
}