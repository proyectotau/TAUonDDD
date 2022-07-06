<?php

namespace ProyectoTAU\TAU\Common;

use ProyectoTAU\TAU\Module\Administration\User\Domain\User;
use ProyectoTAU\TAU\Module\Administration\Group\Domain\Group;
use ProyectoTAU\TAU\Module\Administration\Module\Domain\Module;
use ProyectoTAU\TAU\Module\Administration\Role\Domain\Role;

interface Repository
{
    public function begin(): void;

    public function commit(): void;

    public function rollBack(): void;

    public function clearUser(): void;

    public function clearGroup(): void;

    public function clearRole(): void;

    public function clearModule(): void;

    public function createUser(User $user): void;

    public function readUser($id): User;

    public function readAllUsers(): array;

    public function updateUser($id, $name, $surname, $login): void;

    public function deleteUser($id): void;

    public function createGroup(Group $group): void;

    public function readGroup($id): Group;

    public function updateGroup($id, $name, $desc): void;

    public function deleteGroup($id): void;

    public function createRole(Role $role): void;

    public function readRole($id): Role;

    public function updateRole($id, $name, $desc): void;

    public function deleteRole($id): void;

    public function createModule(Module $module): void;

    public function readModule($id): Module;

    public function updateModule($id, $name, $desc): void;

    public function deleteModule($id): void;

    public function addUserToGroup(User $user, Group $group);

    public function removeUserFromGroup(User $user, Group $group);

    public function addGroupToUser(Group $group, User $user);

    public function removeGroupFromUser(Group $group, User $user);

    public function getGroupsFromUser(User $user): array;

    public function getUsersFromGroup(Group $group): array;

    public function addGroupToRole(Group $group, Role $role);

    public function removeGroupFromRole(Group $group, Role $role);

    public function addRoleToGroup(Role $role, Group $group);

    public function removeRoleFromGroup(Role $role, Group $group);

    public function getRolesFromGroup(Group $group): array;

    public function getGroupsFromRole(Role $role): array;

    public function addRoleToModule(Role $role, Module $module);

    public function removeRoleFromModule(Role $role, Module $module);

    public function addModuleToRole(Module $module, Role $role);

    public function removeModuleFromRole(Module $module, Role $role);

    public function getModulesFromRole(Role $role): array;

    public function getRolesFromModule(Module $module): array;
}
