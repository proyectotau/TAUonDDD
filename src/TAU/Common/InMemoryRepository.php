<?php

namespace ProyectoTAU\TAU\Common;

use Doctrine\Instantiator\Exception\InvalidArgumentException;
use ProyectoTAU\TAU\Module\Administration\User\Domain\User;
use ProyectoTAU\TAU\Module\Administration\Group\Domain\Group;
use ProyectoTAU\TAU\Module\Administration\Role\Domain\Role;
use ProyectoTAU\TAU\Module\Administration\Module\Domain\Module;

/*
 * @see https://phpenthusiast.com/blog/the-singleton-design-pattern-in-php
 */

// General singleton class.
class InMemoryRepository implements Repository
{
    // Hold the class instance.
    private static ?Repository $instance = null;

    // Tables
    private $userDataStore = [];
    private $groupDataStore = [];
    private $roleDataStore = [];
    private $moduleDataStore = [];

    // Relations
    private $user_group = [];
    private $group_role = [];
    private $role_module = [];

    // The constructor is private
    // to prevent initiation with outer code.
    private function __construct()
    {
        // The expensive process (e.g.,db connection) goes here.
    }

    // The object is created from within the class itself
    // only if the class has no instance.
    public static function getInstance(): Repository
    {
        if (self::$instance == null)
        {
            self::$instance = new static();
        }

        return self::$instance;
    }

    /*
     * Transactions
     */
    public function begin(): void
    {
    }

    public function commit(): void
    {
    }

    public function rollBack(): void
    {
    }

    public function clearUser(): void
    {
        $this->userDataStore = [];
        $this->user_group = [];
    }

    public function clearGroup(): void
    {
        $this->groupDataStore = [];
        $this->user_group = [];
        $this->group_role = [];
    }

    public function clearRole(): void
    {
        $this->roleDataStore = [];
        $this->group_role = [];
        $this->role_module = [];
    }

    public function clearModule(): void
    {
        $this->moduleDataStore = [];
        $this->role_module = [];
    }

    /*
     * User
     */
    
    public function createUser(User $user): void
    {
        $this->userDataStore[$user->getId()] = $user;
    }

    public function readUser($id): User
    {
        $this->failIfNotExists('User', $id);

        return $this->userDataStore[$id];
    }

    public function readAllUsers(): array
    {
        return $this->userDataStore;
    }

    public function updateUser($id, $name, $surname, $login): void
    {
        $this->failIfNotExists('User', $id);

        $this->userDataStore[$id]->setName($name);
        $this->userDataStore[$id]->setSurname($surname);
        $this->userDataStore[$id]->setLogin($login);
    }

    public function deleteUser($id): void
    {
        $this->failIfNotExists('User', $id);

        unset($this->userDataStore[$id]);
    }

    /*
     * Group
     */

    public function createGroup(Group $group): void
    {
        $this->groupDataStore[$group->getId()] = $group;
    }

    public function readGroup($id): Group
    {
        $this->failIfNotExists('Group', $id);

        return $this->groupDataStore[$id];
    }

    public function readAllGroups(): array
    {
        return $this->groupDataStore;
    }

    public function updateGroup($id, $name, $desc): void
    {
        $this->failIfNotExists('Group', $id);

        $this->groupDataStore[$id]->setName($name);
        $this->groupDataStore[$id]->setDesc($desc);
    }

    public function deleteGroup($id): void
    {
        $this->failIfNotExists('Group', $id);

        unset($this->groupDataStore[$id]);
    }

    /*
     * Role
     */

    public function createRole(Role $role): void
    {
        $this->roleDataStore[$role->getId()] = $role;
    }

    public function readRole($id): Role
    {
        $this->failIfNotExists('Role', $id);

        return $this->roleDataStore[$id];
    }

    public function readAllRoles(): array
    {
        return $this->roleDataStore;
    }

    public function updateRole($id, $name, $desc): void
    {
        $this->failIfNotExists('Role', $id);

        $this->roleDataStore[$id]->setName($name);
        $this->roleDataStore[$id]->setDesc($desc);
    }

    public function deleteRole($id): void
    {
        $this->failIfNotExists('Role', $id);

        unset($this->roleDataStore[$id]);
    }

    /*
     * Module
     */

    public function createModule(Module $module): void
    {
        $this->moduleDataStore[$module->getId()] = $module;
    }

    public function readModule($id): Module
    {
        $this->failIfNotExists('Module', $id);

        return $this->moduleDataStore[$id];
    }

    public function readAllModules(): array
    {
        return $this->moduleDataStore;
    }

    public function updateModule($id, $name, $desc): void
    {
        $this->failIfNotExists('Module', $id);

        $this->moduleDataStore[$id]->setName($name);
        $this->moduleDataStore[$id]->setDesc($desc);
    }

    public function deleteModule($id): void
    {
        unset($this->moduleDataStore[$id]);
    }
    
    /*
     * Relations
     */

    public function addUserToGroup(User $user, Group $group)
    {
        $this->user_group[$user->getId()][$group->getId()] = [$user, $group];
    }

    public function removeUserFromGroup(User $user, Group $group)
    {
        unset($this->user_group[$user->getId()][$group->getId()]);
    }

    public function addGroupToUser(Group $group, User $user)
    {
        $this->user_group[$user->getId()][$group->getId()] = [$user, $group];
    }

    public function removeGroupFromUser(Group $group, User $user)
    {
        unset($this->user_group[$user->getId()][$group->getId()]);
    }

    public function getGroupsFromUser(User $user): array
    {
        return $this->extractY($this->user_group, 'belongsto', $this->groupDataStore, $user);
    }

    public function getUsersFromGroup(Group $group): array
    {
        return $this->extractX($this->user_group, 'members', $this->userDataStore, $group);
    }

    public function addGroupToRole(Group $group, Role $role)
    {
        $this->group_role[$group->getId()][$role->getId()] = [$group, $role];
    }

    public function removeGroupFromRole(Group $group, Role $role)
    {
        unset($this->group_role[$group->getId()][$role->getId()]);
    }

    public function addRoleToGroup(Role $role, Group $group)
    {
        $this->group_role[$group->getId()][$role->getId()] = [$group, $role];
    }

    public function removeRoleFromGroup(Role $role, Group $group)
    {
        unset($this->group_role[$group->getId()][$role->getId()]);
    }

    public function getRolesFromGroup(Group $group): array
    {
        return $this->extractY($this->group_role, 'plays', $this->roleDataStore, $group);
    }

    public function getGroupsFromRole(Role $role): array
    {
        return $this->extractX($this->group_role, 'grantedby', $this->groupDataStore, $role);
    }

    public function addRoleToModule(Role $role, Module $module)
    {
        $this->role_module[$role->getId()][$module->getId()] = [$role, $module];
    }

    public function removeRoleFromModule(Role $role, Module $module)
    {
        unset($this->role_module[$role->getId()][$module->getId()]);
    }

    public function addModuleToRole(Module $module, Role $role)
    {
        $this->role_module[$role->getId()][$module->getId()] = [$role, $module];
    }

    public function removeModuleFromRole(Module $module, Role $role)
    {
        unset($this->role_module[$role->getId()][$module->getId()]);
    }

    public function getModulesFromRole(Role $role): array
    {
        return $this->extractY($this->role_module, 'canrun', $this->moduleDataStore, $role);
    }

    public function getRolesFromModule(Module $module): array
    {
        return $this->extractX($this->role_module, 'authorizedby', $this->roleDataStore, $module);
    }

    /*
     * Privates
     */

    private function extractX($from, $who, $available, $entityY): array
    {
        $r = [
            $who => [],
            'available' => $available
        ];

        foreach($from as $xKey => $xs)
            foreach($xs as $yKey => $pair)
                if( $yKey === $entityY->getId() ) {
                    $r[$who][$xKey] = $pair[0];
                    unset($r['available'][$xKey]);
                }

        return $r;
    }

    private function extractY($from, $who, $available, $entityX): array
    {
        $r = [
            $who => [],
            'available' => $available
        ];

        foreach($from as $xKey => $xs)
            foreach($xs as $yKey => $pair)
                if ($xKey === $entityX->getId()) {
                    $r[$who][$yKey] = $pair[1];
                    unset($r['available'][$yKey]);
                }

        return $r;
    }

    private function failIfNotExists($entity, $id)
    {
        $datastore = strtolower($entity) . 'DataStore';
        if( ! isset($this->$datastore[$id]) ){
            throw new InvalidArgumentException(ucfirst($entity)." with id = {$id} not found");
        }
    }
}
