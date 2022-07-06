<?php

namespace ProyectoTAU\TAU\Module\Administration\User\Domain;

use ProyectoTAU\TAU\Module\Administration\Group\Domain\Group;

interface UserRepository
{
    public function clear(): void;

    public function create(User $user): void;
    public function read($id): User;
    public function update($id, $name, $surname, $login): void;
    public function delete($id): void;

    public function readAll(): array;

    public function addGroupToUser(Group $group, User $user): void;
    public function removeGroupFromUser(Group $group, User $user): void;
    public function getGroupsFromUser(User $user): array;
}
