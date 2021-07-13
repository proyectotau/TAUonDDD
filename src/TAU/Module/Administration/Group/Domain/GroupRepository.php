<?php

namespace ProyectoTAU\TAU\Module\Administration\Group\Domain;

interface GroupRepository
{
    public function create(Group $group): void;
    public function read($id): Group;
    public function update($id, $name, $desc): void;
    public function delete($id): void;
}
