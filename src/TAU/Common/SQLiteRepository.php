<?php

namespace ProyectoTAU\TAU\Common;

use Doctrine\Instantiator\Exception\InvalidArgumentException;
use PDO;
use PDOException;
use ProyectoTAU\TAU\Module\Administration\User\Domain\User;
use ProyectoTAU\TAU\Module\Administration\Group\Domain\Group;
use ProyectoTAU\TAU\Module\Administration\Role\Domain\Role;
use ProyectoTAU\TAU\Module\Administration\Module\Domain\Module;
use ProyectoTAU\TAU\Module\Administration\User\Domain\UserId;
use ProyectoTAU\TAU\Module\Administration\Group\Domain\GroupId;

/*
 * @see https://phpenthusiast.com/blog/the-singleton-design-pattern-in-php
 */

// General singleton class.
class SQLiteRepository
{
    // Hold the class instance.
    private static $instance = null;
    private static $db = null;

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
        $dbname = __DIR__ . '/admin.sqlite3';
        try {
            self::$db = new PDO('sqlite:' . $dbname);
            self::$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            //self::$db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
        } catch (PDOException $e) {
            die($e->getMessage().' ('.$dbname.')');
        }
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

    /*
     * @see https://www.tutorialspoint.com/sqlite/sqlite_truncate_table.htm
     */
    public function clearUser()
    {
        $ps = self::$db->prepare('DELETE FROM user_group;');
        $this->executeOrFail($ps);

        $ps = self::$db->prepare('DELETE FROM User;');
        $this->executeOrFail($ps);
    }

    public function clearGroup()
    {
        $ps = self::$db->query('DELETE FROM user_group;');
        $this->executeOrFail($ps);

        $ps = self::$db->prepare('DELETE FROM "Group";');
        $this->executeOrFail($ps);
    }

    public function clearRole()
    {
        $ps = self::$db->query('DELETE FROM group_role;');
        $this->executeOrFail($ps);

        $ps = self::$db->prepare('DELETE FROM "Group";');
        $this->executeOrFail($ps);

        $ps = self::$db->prepare('DELETE FROM Role;');
        $this->executeOrFail($ps);
    }

    public function clearModule()
    {
        $ps = self::$db->query('DELETE FROM role_module;');
        $this->executeOrFail($ps);

        $ps = self::$db->prepare('DELETE FROM Role;');
        $this->executeOrFail($ps);

        $ps = self::$db->prepare('DELETE FROM Module;');
        $this->executeOrFail($ps);
    }

    /*
     * User
     */

    public function createUser(User $user): void
    {
        $ps = self::$db->prepare('INSERT INTO User (user_id, name, surname, login)'.
                                            ' VALUES(:user_id, :name, :surname, :login);');
        $this->executeOrFail($ps, [
            ':user_id' => $user->getId(),
            ':name' => $user->getName(),
            ':surname' => $user->getSurname(),
            ':login' => $user->getLogin()
        ]);

        $this->userDataStore[$user->getId()] = self::$db->lastInsertId();
    }

    public function readUser($id): User
    {
        $ps = self::$db->prepare('SELECT user_pk, user_id, name, surname, login FROM User WHERE user_id = :id;');

        $this->executeOrFail($ps, [':id' => $id]);

        $resultSet = $ps->fetch(PDO::FETCH_ASSOC);
        if( $resultSet === false )
            throw new InvalidArgumentException("User with id = {$id} not found");

        $ref = new \ReflectionClass(User::class);
        $user = $this->castUser($ref->newInstanceWithoutConstructor());

        $user->setId($resultSet['user_id']);
        $user->setName($resultSet['name']);
        $user->setSurname($resultSet['surname']);
        $user->setLogin($resultSet['login']);

        $this->userDataStore[$user->getId()] = $resultSet['user_pk'];

        return $user;
    }

    public function updateUser($id, $name, $surname, $login): void
    {
        $ps = self::$db->prepare('UPDATE User SET '.
                                            'name = :name,'.
                                            'surname = :surname,'.
                                            'login = :login'.
                                            ' WHERE user_id = :id;');

        $this->executeOrFail($ps, [
            ':id' => $id,
            ':name' => $name,
            ':surname' => $surname,
            ':login' => $login
        ]);
    }

    public function deleteUser($id): void
    {
        $ps = self::$db->prepare('DELETE FROM User WHERE user_pk = :user_pk;');

        $user_pk = $this->userDataStore[$id];

        $this->executeOrFail($ps, [':user_pk' => $user_pk]);

        unset($this->userDataStore[$id]);
    }

    public function getGroupsFromUser(User $user): array // TODO id instead of User
    {
        $ps = self::$db->prepare('SELECT group_pk, g.group_id, name, description FROM "Group" g'.
                                        ' INNER JOIN user_group rel ON g.group_pk = rel.group_fk'.
                                        ' WHERE rel.user_fk = :user_fk;');

        $id = $user->getid();
        $user_fk = $this->userDataStore[$id];

        $resultSet = $this->queryOrFail($ps, [':user_fk' => $user_fk]);

        $groups = [];
        foreach ($resultSet as $entry) {
            $ref = new \ReflectionClass(Group::class);
            $group = $this->castGroup($ref->newInstanceWithoutConstructor());

            $group->setPropertiesBag(['id', 'name', 'desc']);
            $group->setSettersBag($group->getPropertiesBag());

            $group->setId($entry['group_id']);
            $group->setName($entry['name']);
            $group->setDesc($entry['description']);

            $groups[$entry['group_id']] = $group;
        }

        $available = array_diff_assoc($this->getAllGroups(), $groups);
        $r = [
            'belongsto' => $groups,
            'available' => $available
        ];

        return $r;
    }

    private function castUser($o): User
    {
        return $o;
    }

    private function castGroup($o): Group
    {
        return $o;
    }

    private function queryOrFail($ps, $params = []): array
    {
        $this->executeOrFail($ps, $params);
        $resultSet =  $ps->fetchAll(PDO::FETCH_ASSOC);

        return $resultSet;
    }

    private function executeOrFail($ps, $params = [], $a = 0): void
    {
        $a = 1;
        if($a) {
            $sql = $ps->queryString;
            $b = str_replace(array_keys($params), array_values($params), $sql);
            echo "\n$b\n";
        }

        $result = $ps->execute($params);

        if( $result === false ) {
            $a = 1;
            if($a) {
                $sql = $ps->queryString;
                $b = str_replace(array_keys($params), array_values($params), $sql);
                echo "\n$b\n";
            }

            throw new \Exception($ps->errorInfo(), $ps->errorCode());
        }
    }

    private function getAllGroups(): array
    {
        $ps = self::$db->prepare('SELECT group_pk, group_id, group_id, name, description FROM "Group";');

        $resultSet = $this->queryOrFail($ps);

        $groups = [];
        foreach ($resultSet as $entry) {
            $ref = new \ReflectionClass(Group::class);
            $group = $this->castGroup($ref->newInstanceWithoutConstructor());

            $group->setPropertiesBag(['id', 'name', 'desc']);
            $group->setSettersBag($group->getPropertiesBag());

            $group->setId($entry['group_id']);
            $group->setName($entry['name']);
            $group->setDesc($entry['description']);

            $this->groupDataStore[$entry['group_id']] = $entry['group_pk'];

            $groups[$entry['group_id']] = $group;
        }

        return $groups;
    }

    public function createGroup(Group $group)
    {
        $ps = self::$db->prepare('INSERT INTO "Group" (group_id, name, description)'.
                                            ' VALUES(:group_id, :name, :description);');
        $this->executeOrFail($ps, [
            ':group_id' => $group->getId(),
            ':name' => $group->getName(),
            ':description' => $group->getDesc()
        ]);

        $this->groupDataStore[$group->getId()] = self::$db->lastInsertId();
    }

    public function readGroup($id)
    {
        $ps = self::$db->prepare('SELECT group_pk, group_id, name, description FROM "Group" WHERE group_id = :id;');

        $this->executeOrFail($ps, [':id' => $id]);

        $resultSet = $ps->fetch(PDO::FETCH_ASSOC);
        if( $resultSet === false )
            throw new InvalidArgumentException("Group with id = {$id} not found");

        $ref = new \ReflectionClass(Group::class);
        $group = $this->castGroup($ref->newInstanceWithoutConstructor());

        $group->setPropertiesBag(['id', 'name', 'desc']);
        $group->setSettersBag($group->getPropertiesBag());

        $group->setId($resultSet['group_id']);
        $group->setName($resultSet['name']);
        $group->setDesc($resultSet['description']);

        $this->groupDataStore[$group->getId()] = $resultSet['group_pk'];

        return $group;
    }

    public function updateGroup($id, $name, $desc)
    {
        $ps = self::$db->prepare('UPDATE "Group" SET '.
                                            'name = :name,'.
                                            'description = :description'.
                                            ' WHERE group_id = :id;');

        $this->executeOrFail($ps, [
            ':id' => $id,
            ':name' => $name,
            ':description' => $desc
        ]);
    }

    public function deleteGroup($id)
    {
        $ps = self::$db->prepare('DELETE FROM "Group" WHERE group_pk = :group_pk;');

        $group_pk = $this->groupDataStore[$id];

        $this->executeOrFail($ps, [':group_pk' => $group_pk]);

        unset($this->groupDataStore[$id]);
    }

    public function getUsersFromGroup(Group $group)
    {
        $ps = self::$db->prepare('SELECT user_pk, u.user_id, name, surname, login FROM User u'.
                                        ' INNER JOIN user_group rel ON u.user_pk = rel.user_fk'.
                                        ' WHERE rel.group_fk = :group_fk;');

        $id = $group->getId();
        $group_fk = $this->groupDataStore[$id];

        $resultSet = $this->queryOrFail($ps, [':group_fk' => $group_fk]);

        $users = [];
        foreach ($resultSet as $entry) {
            $ref = new \ReflectionClass(User::class);
            $user = $this->castUser($ref->newInstanceWithoutConstructor());

            $user->setId($entry['user_id']);
            $user->setName($entry['name']);
            $user->setSurname($entry['surname']);
            $user->setLogin($entry['login']);

            $users[$entry['user_id']] = $user;
        }

        $available = array_diff_assoc($this->getAllUsers(), $users);
        $r = [
            'members' => $users,
            'available' => $available
        ];

        return $r;
    }

    private function getAllUsers(): array
    {
        $ps = self::$db->prepare('SELECT user_pk, user_id, name, surname, login FROM User;');

        $resultSet = $this->queryOrFail($ps);

        $users = [];
        foreach ($resultSet as $entry) {
            $ref = new \ReflectionClass(User::class);
            $user = $this->castUser($ref->newInstanceWithoutConstructor());

            $user->setId($entry['user_id']);
            $user->setName($entry['name']);
            $user->setSurname($entry['surname']);
            $user->setLogin($entry['login']);

            $this->userDataStore[$entry['user_id']] = $entry['user_pk'];

            $users[$entry['user_id']] = $user;
        }

        return $users;
    }

    public function addUserToGroup(User $user, Group $group)
    {
        /*$ps = self::$db->prepare('INSERT INTO user_group (user_fk, group_fk, user_id, group_id)'.
                                        ' VALUES (:user_fk, :group_fk, :user_id, :group_id);');*/
        $ps = self::$db->prepare('INSERT INTO user_group (user_fk, group_fk)'.
                                        ' VALUES (:user_fk, :group_fk);');

        $this->executeOrFail($ps, [
            ':user_fk' => $this->userDataStore[$user->getId()],
            ':group_fk' => $this->groupDataStore[$group->getId()],
            //':user_id' => $user->getId(),
            //':group_id' => $group->getId()
        ]);
    }

    public function removeUserFromGroup(User $user, Group $group)
    {
        $ps = self::$db->prepare('DELETE FROM user_group WHERE user_fk = :user_fk'.
                                        ' AND group_fk = :group_fk;');

        $this->executeOrFail($ps, [
            ':user_fk' => $this->userDataStore[$user->getId()],
            ':group_fk' => $this->groupDataStore[$group->getId()],
            //':user_id' => $user->getId(),
            //':group_id' => $group->getId()
        ]);
    }

    public function createRole(Role $role)
    {
        $ps = self::$db->prepare('INSERT INTO Role (role_id, name, description)'.
                                        ' VALUES(:role_id, :name, :description);');

        $this->executeOrFail($ps, [
            ':role_id' => $role->getId(),
            ':name' => $role->getName(),
            ':description' => $role->getDesc()
        ]);

        $this->roleDataStore[$role->getId()] = self::$db->lastInsertId();
    }

    public function readRole($id)
    {
        $ps = self::$db->prepare('SELECT role_pk, role_id, name, description FROM Role WHERE role_id = :id;');

        $this->executeOrFail($ps, [':id' => $id]);

        $resultSet = $ps->fetch(PDO::FETCH_ASSOC);
        if( $resultSet === false )
            throw new InvalidArgumentException("Role with id = {$id} not found");

        $ref = new \ReflectionClass(Role::class);
        $role = $this->castRole($ref->newInstanceWithoutConstructor());

        $role->setPropertiesBag(['id', 'name', 'desc']);
        $role->setSettersBag($role->getPropertiesBag());

        $role->setId($resultSet['role_id']);
        $role->setName($resultSet['name']);
        $role->setDesc($resultSet['description']);

        $this->roleDataStore[$role->getId()] = $resultSet['role_pk'];

        return $role;
    }

    private function castRole($o): Role
    {
        return $o;
    }

    public function addGroupToRole(Group $group, Role $role)
    {
        $ps = self::$db->prepare('INSERT INTO group_role (group_fk, role_fk, group_id, role_id)'.
                                        ' VALUES (:group_fk, :role_fk, :group_id, :role_id);');

        $this->executeOrFail($ps, [
            ':group_fk' => $this->groupDataStore[$group->getId()],
            ':role_fk' => $this->roleDataStore[$role->getId()],
            ':group_id' => $group->getId(),
            ':role_id' => $role->getId()
        ]);
    }

    public function getGroupsFromRole(Role $role)
    {
        $ps = self::$db->prepare('SELECT group_pk, g.group_id, name, description FROM "Group" g'.
            ' INNER JOIN group_role rel ON g.group_pk = rel.group_fk'.
            ' WHERE rel.role_fk = :role_fk;');

        $id = $role->getId();
        $role_fk = $this->roleDataStore[$id];

        $resultSet = $this->queryOrFail($ps, [':role_fk' => $role_fk]);

        $groups = [];
        foreach ($resultSet as $entry) {
            $ref = new \ReflectionClass(Group::class);
            $group = $this->castGroup($ref->newInstanceWithoutConstructor());

            $group->setPropertiesBag(['id', 'name', 'desc']);
            $group->setSettersBag($group->getPropertiesBag());

            $group->setId($entry['group_id']);
            $group->setName($entry['name']);
            $group->setDesc($entry['description']);

            $groups[$entry['group_id']] = $group;
        }

        $available = array_diff_assoc($this->getAllGroups(), $groups);
        $r = [
            'grantedby' => $groups,
            'available' => $available
        ];

        return $r;
    }

    public function removeGroupFromRole(Group $group, Role $role)
    {
        $ps = self::$db->prepare('DELETE FROM group_role WHERE group_fk = :group_fk'.
                                        ' AND role_fk = :role_fk;');

        $this->executeOrFail($ps, [
            ':group_fk' => $this->groupDataStore[$group->getId()],
            ':role_fk' => $this->roleDataStore[$role->getId()],
            //':group_id' => $group->getId(),
            //':role_id' => $role->getId()
        ]);
    }

    public function addGroupToUser(Group $group, User $user)
    {
        $ps = self::$db->prepare('INSERT INTO user_group (user_fk, group_fk, group_id, user_id)'.
                                        ' VALUES (:user_fk, :group_fk, :user_id, :group_id);');

        $this->executeOrFail($ps, [
            ':user_fk' => $this->userDataStore[$user->getId()],
            ':group_fk' => $this->groupDataStore[$group->getId()],
            ':user_id' => $user->getId(),
            ':group_id' => $group->getId()
        ]);
    }

    public function removeGroupFromUser(Group $group, User $user)
    {
        $ps = self::$db->prepare('DELETE FROM user_group WHERE user_fk = :user_fk'.
            ' AND group_fk = :group_fk;');

        $this->executeOrFail($ps, [
            ':user_fk' => $this->userDataStore[$user->getId()],
            ':group_fk' => $this->groupDataStore[$group->getId()],
            //':role_id' => $role->getId()
            //':group_id' => $group->getId(),
        ]);
    }

    public function updateRole($id, $name, $desc)
    {
        $ps = self::$db->prepare('UPDATE Role SET '.
            'name = :name,'.
            'description = :description'.
            ' WHERE role_id = :id;');

        $this->executeOrFail($ps, [
            ':id' => $id,
            ':name' => $name,
            ':description' => $desc
        ]);
    }

    public function deleteRole($id)
    {
        $ps = self::$db->prepare('DELETE FROM Role WHERE role_pk = :role_pk;');

        $role_pk = $this->roleDataStore[$id];

        $this->executeOrFail($ps, [':role_pk' => $role_pk]);

        unset($this->roleDataStore[$id]);
    }

    public function addRoleToGroup(Role $role, Group $group)
    {
        $ps = self::$db->prepare('INSERT INTO group_role (group_fk, role_fk, group_id, role_id)'.
                                        ' VALUES (:group_fk, :role_fk, :group_id, :role_id);');

        $this->executeOrFail($ps, [
            ':group_fk' => $this->groupDataStore[$group->getId()],
            ':role_fk' => $this->roleDataStore[$role->getId()],
            ':group_id' => $group->getId(),
            ':role_id' => $role->getId()
        ]);
    }

    public function getRolesFromGroup(Group $group)
    {
        $ps = self::$db->prepare('SELECT role_pk, r.role_id, name, description FROM Role r'.
            ' INNER JOIN group_role rel ON r.role_pk = rel.role_fk'.
            ' WHERE rel.group_fk = :group_fk;');

        $id = $group->getId();
        $group_fk = $this->groupDataStore[$id];

        $resultSet = $this->queryOrFail($ps, [':group_fk' => $group_fk]);

        $roles = [];
        foreach ($resultSet as $entry) {
            $ref = new \ReflectionClass(Role::class);
            $role = $this->castRole($ref->newInstanceWithoutConstructor());

            $role->setPropertiesBag(['id', 'name', 'desc']);
            $role->setSettersBag($role->getPropertiesBag());

            $role->setId($entry['role_id']);
            $role->setName($entry['name']);
            $role->setDesc($entry['description']);

            $roles[$entry['role_id']] = $role;
        }

        $available = array_diff_assoc($this->getAllRoles(), $roles);
        $r = [
            'plays' => $roles,
            'available' => $available
        ];

        return $r;
    }

    private function getAllRoles()
    {
        $ps = self::$db->prepare('SELECT role_pk, role_id, role_id, name, description FROM Role;');

        $resultSet = $this->queryOrFail($ps);

        $roles = [];
        foreach ($resultSet as $entry) {
            $ref = new \ReflectionClass(Role::class);
            $role = $this->castRole($ref->newInstanceWithoutConstructor());

            $role->setPropertiesBag(['id', 'name', 'desc']);
            $role->setSettersBag($role->getPropertiesBag());

            $role->setId($entry['role_id']);
            $role->setName($entry['name']);
            $role->setDesc($entry['description']);

            $this->roleDataStore[$entry['role_id']] = $entry['role_pk'];

            $roles[$entry['role_id']] = $role;
        }

        return $roles;
    }

    public function removeRoleFromGroup(Role $role, Group $group)
    {
        $ps = self::$db->prepare('DELETE FROM group_role WHERE role_fk = :role_fk'.
                                        ' AND group_fk = :group_fk;');

        $this->executeOrFail($ps, [
            ':role_fk' => $this->roleDataStore[$role->getId()],
            ':group_fk' => $this->groupDataStore[$group->getId()],
            //':role_id' => $role->getId(),
            //':group_id' => $group->getId()
        ]);
    }

    public function addModuleToRole(Module $module, Role $role)
    {
        $ps = self::$db->prepare('INSERT INTO role_module (role_fk, module_fk, role_id, module_id)'.
            ' VALUES (:role_fk, :module_fk, :role_id, :module_id);');

        $this->executeOrFail($ps, [
            ':role_fk' => $this->roleDataStore[$role->getId()],
            ':module_fk' => $this->moduleDataStore[$module->getId()],
            ':role_id' => $role->getId(),
            ':module_id' => $module->getId()
        ]);
    }

    public function removeModuleFromRole(Module $module, Role $role)
    {
        $ps = self::$db->prepare('DELETE FROM role_module WHERE role_fk = :role_fk'.
                                        ' AND module_fk = :module_fk;');

        $this->executeOrFail($ps, [
            ':module_fk' => $this->moduleDataStore[$module->getId()],
            ':role_fk' => $this->roleDataStore[$role->getId()],
            //':module_id' => $module->getId(),
            //':role_id' => $role->getId()
        ]);
    }

    public function getModulesFromRole(Role $role)
    {
        $ps = self::$db->prepare('SELECT module_pk, m.module_id, name, description FROM Module m'.
                                        ' INNER JOIN role_module rel ON m.module_pk = rel.module_fk'.
                                        ' WHERE rel.role_fk = :role_fk;');

        $id = $role->getId();
        $role_fk = $this->roleDataStore[$id];

        $resultSet = $this->queryOrFail($ps, [':role_fk' => $role_fk]);

        $modules = [];
        foreach ($resultSet as $entry) {
            $ref = new \ReflectionClass(Module::class);
            $module = $this->castModule($ref->newInstanceWithoutConstructor());

            $module->setPropertiesBag(['id', 'name', 'desc']);
            $module->setSettersBag($module->getPropertiesBag());

            $module->setId($entry['module_id']);
            $module->setName($entry['name']);
            $module->setDesc($entry['description']);

            $modules[$entry['module_id']] = $module;
        }

        $available = array_diff_assoc($this->getAllModules(), $modules);
        $r = [
            'canrun' => $modules,
            'available' => $available
        ];

        return $r;
    }

    private function castModule($o): Module
    {
        return $o;
    }

    private function getAllModules()
    {
        $ps = self::$db->prepare('SELECT module_pk, module_id, module_id, name, description FROM Module;');

        $resultSet = $this->queryOrFail($ps);

        $modules = [];
        foreach ($resultSet as $entry) {
            $ref = new \ReflectionClass(Module::class);
            $module = $this->castModule($ref->newInstanceWithoutConstructor());

            $module->setPropertiesBag(['id', 'name', 'desc']);
            $module->setSettersBag($module->getPropertiesBag());

            $module->setId($entry['module_id']);
            $module->setName($entry['name']);
            $module->setDesc($entry['description']);

            $this->moduleDataStore[$entry['module_id']] = $entry['module_pk'];

            $modules[$entry['module_id']] = $module;
        }

        return $modules;
    }

    public function createModule(Module $module)
    {
        $ps = self::$db->prepare('INSERT INTO Module (module_id, name, description)'.
                                        ' VALUES(:module_id, :name, :description);');
        $this->executeOrFail($ps, [
            ':module_id' => $module->getId(),
            ':name' => $module->getName(),
            ':description' => $module->getDesc()
        ]);

        $this->moduleDataStore[$module->getId()] = self::$db->lastInsertId();
    }

    public function readModule($id)
    {
        $ps = self::$db->prepare('SELECT module_pk, module_id, name, description FROM Module WHERE module_id = :id;');

        $this->executeOrFail($ps, [':id' => $id]);

        $resultSet = $ps->fetch(PDO::FETCH_ASSOC);
        if( $resultSet === false )
            throw new InvalidArgumentException("Module with id = {$id} not found");

        $ref = new \ReflectionClass(Module::class);
        $module = $this->castModule($ref->newInstanceWithoutConstructor());

        $module->setPropertiesBag(['id', 'name', 'desc']);
        $module->setSettersBag($module->getPropertiesBag());

        $module->setId($resultSet['module_id']);
        $module->setName($resultSet['name']);
        $module->setDesc($resultSet['description']);

        $this->moduleDataStore[$module->getId()] = $resultSet['module_pk'];

        return $module;
    }

    public function updateModule($id, $name, $desc)
    {
        $ps = self::$db->prepare('UPDATE Module SET '.
                                        'name = :name,'.
                                        'description = :description'.
                                        ' WHERE module_id = :id;');

        $this->executeOrFail($ps, [
            ':id' => $id,
            ':name' => $name,
            ':description' => $desc
        ]);
    }

    public function deleteModule($id)
    {
        $ps = self::$db->prepare('DELETE FROM Module WHERE module_pk = :module_pk;');

        $module_pk = $this->moduleDataStore[$id];

        $this->executeOrFail($ps, [':module_pk' => $module_pk]);

        unset($this->moduleDataStore[$id]);
    }

    public function addRoleToModule(Role $role, Module $module)
    {
        $this->addModuleToRole($module, $role);
    }

    public function removeRoleFromModule(Role $role, Module $module)
    {
        $this->removeModuleFromRole($module, $role);
    }

    public function getRolesFromModule(Module $module)
    {
        $ps = self::$db->prepare('SELECT role_pk, r.role_id, name, description FROM Role r'.
            ' INNER JOIN role_module rel ON r.role_pk = rel.role_fk'.
            ' WHERE rel.module_fk = :module_fk;');

        $id = $module->getId();
        $module_fk = $this->moduleDataStore[$id];

        $resultSet = $this->queryOrFail($ps, [':module_fk' => $module_fk]);

        $roles = [];
        foreach ($resultSet as $entry) {
            $ref = new \ReflectionClass(Role::class);
            $role = $this->castRole($ref->newInstanceWithoutConstructor());

            $role->setPropertiesBag(['id', 'name', 'desc']);
            $role->setSettersBag($role->getPropertiesBag());

            $role->setId($entry['role_id']);
            $role->setName($entry['name']);
            $role->setDesc($entry['description']);

            $roles[$entry['role_id']] = $role;
        }

        $available = array_diff_assoc($this->getAllRoles(), $roles);
        $r = [
            'authorizedby' => $roles,
            'available' => $available
        ];

        return $r;
    }
}
