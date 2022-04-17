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
class InMemoryRepository
{
    // Hold the class instance.
    private static $instance = null;

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
    public static function getInstance()
    {
        if (self::$instance == null)
        {
            self::$instance = new static();
        }

        return self::$instance;
    }

    public function clear()
    {
        $this->groupDataStore = [];
        $this->userDataStore = [];
        $this->roleDataStore = [];
        $this->moduleDataStore = [];
        $this->user_group = [];
        $this->group_role = [];
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

    public function updateUser($id, $name, $surname, $login): void
    {
        $this->failIfNotExists('User', $id);

        $this->userDataStore[$id]->setName($name);
        $this->userDataStore[$id]->setName($surname);
        $this->userDataStore[$id]->setName($login);
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

    public function updateGroup($id, $name, $desc): void
    {
        $this->failIfNotExists('Group', $id);

        $this->groupDataStore[$id]->setName($name);
        $this->groupDataStore[$id]->setName($desc);
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

    public function updateRole($id, $name, $desc): void
    {
        $this->failIfNotExists('Role', $id);

        $this->roleDataStore[$id]->setName($name);
        $this->roleDataStore[$id]->setName($desc);
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

    public function updateModule($id, $name, $desc): void
    {
        $this->failIfNotExists('Module', $id);

        $this->moduleDataStore[$id]->setName($name);
        $this->moduleDataStore[$id]->setName($desc);
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

    public function removeUserToGroup(User $user, Group $group)
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

    public function removeRoleToGroup(Role $role, Group $group)
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

    public function addModuleToRole(Module $module, Role $role)
    {
        $this->role_module[$role->getId()][$module->getId()] = [$role, $module];
    }

    public function getModulesFromRole(Role $role): array
    {
        return $this->extractY($this->role_module, 'canRun', $this->moduleDataStore, $role);
    }

    public function getRolesFromModule(Module $module): array
    {
        return $this->extractX($this->role_module, 'authorizedBy', $this->roleDataStore, $module);
    }

    /*
     * Privates
     */

    private function extractX($from, $who, $available, $entityY)
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

    private function extractY($from, $who, $available, $entityX)
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
