<?php

namespace ProyectoTAU\TAU\Common;

use ProyectoTAU\TAU\Module\Administration\User\Domain\User;
use ProyectoTAU\TAU\Module\Administration\Group\Domain\Group;
use ProyectoTAU\TAU\Module\Administration\Role\Domain\Role;

/*
 * @see https://phpenthusiast.com/blog/the-singleton-design-pattern-in-php
 */

// General singleton class.
class InMemoryRepository {
    // Hold the class instance.
    private static $instance = null;

    private $userDataStore = [];
    private $groupDataStore = [];
    private $roleDataStore = [];

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
            self::$instance = new self();
        }

        return self::$instance;
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
        return $this->userDataStore[$id];
    }

    public function updateUser($id, $name, $surname, $login): void
    {
        $this->userDataStore[$id]->setName($name);
        $this->userDataStore[$id]->setName($surname);
        $this->userDataStore[$id]->setName($login);
    }

    public function deleteUser($id): void
    {
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
        return $this->groupDataStore[$id];
    }

    public function updateGroup($id, $name, $desc): void
    {
        $this->groupDataStore[$id]->setName($name);
        $this->groupDataStore[$id]->setName($desc);
    }

    public function deleteGroup($id): void
    {
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
        return $this->roleDataStore[$id];
    }

    public function updateRole($id, $name, $desc): void
    {
        $this->roleDataStore[$id]->setName($name);
        $this->roleDataStore[$id]->setName($desc);
    }

    public function deleteRole($id): void
    {
        unset($this->roleDataStore[$id]);
    }
}
