<?php

namespace ProyectoTAU\TAU\Module\Administration\Role\Domain;

interface RoleRepository
{
    public function create($id, $name, $desc): void;
    public function read($id): void;
    public function update($id, $name, $desc): void;
    public function delete($id): void;
}
