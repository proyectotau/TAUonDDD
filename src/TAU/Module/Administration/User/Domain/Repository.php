<?php

namespace ProyectoTAU\TAU\Module\Administration\User\Domain;

interface Repository
{
    public function save(User $user): void;
    public function delete($id): void;
}