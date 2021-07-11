<?php

namespace ProyectoTAU\TAU\Module\Administration\Group\Domain;

interface GroupRepository
{
    public function create($id, $name, $desc): void;
    public function read($id): void;
    public function update($id, $name, $desc): void;
    public function delete($id): void;
}
