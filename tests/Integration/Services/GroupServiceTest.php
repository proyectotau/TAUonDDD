<?php

namespace ProyectoTAU\Tests\Integration\Services;

use PHPUnit\Framework\TestCase;
use ProyectoTAU\TAU\Module\Administration\User\Application\UserService;
use ProyectoTAU\TAU\Module\Administration\Group\Application\GroupService;
use ProyectoTAU\TAU\Module\Administration\Role\Application\RoleService;

class GroupServiceTest  extends TestCase
{
    public function setUp(): void
    {
        $em = app()->get('EntityManager');
        $em->clearUser();
        $em->clearGroup();
        $em->clearRole();
    }

    public function testServiceCanCreateGroup()
    {
        GroupService::create(1, 'Test', 'Dummy');
        $this->assertTrue(true);
    }

    public function testServiceCanReadGroup()
    {
        GroupService::create(1, 'Test', 'Dummy');

        GroupService::read(1);
        $this->assertTrue(true);
    }

    public function testServiceCanUpdateGroup()
    {
        GroupService::create(1, 'Test', 'Dummy');

        GroupService::update(1, 'TestOK', 'DummyOK');
        $this->assertTrue(true);
    }

    public function testServiceCanDeleteGroup()
    {
        GroupService::create(1, 'Test', 'Dummy');

        GroupService::delete(1);
        $this->assertTrue(true);
    }

    public function testServiceCanAddUserToGroup()
    {
        UserService::create(1, 'Test', 'Dummy', 'fakelogin');
        GroupService::create(1, 'Test', 'Dummy');

        GroupService::addUserToGroup(1, 1);
        $this->assertTrue(true);
    }

    public function testServiceCanGetUsersFromGroup()
    {
        UserService::create(1, 'Test', 'Dummy', 'fakelogin');
        GroupService::create(1, 'Test', 'Dummy');
        GroupService::addUserToGroup(1, 1);

        GroupService::getUsersFromGroup(1, 1);
        $this->assertTrue(true);
    }

    public function testServiceCanRemoveUserFromGroup()
    {
        UserService::create(1, 'Test', 'Dummy', 'fakelogin');
        GroupService::create(1, 'Test', 'Dummy');
        GroupService::addUserToGroup(1, 1);

        GroupService::removeUserFromGroup(1, 1);
        $this->assertTrue(true);
    }

    public function testServiceCanAddRoleToGroup()
    {
        GroupService::create(1, 'Test', 'Dummy');
        RoleService::create(1, 'Test', 'Dummy');

        GroupService::addRoleToGroup(1,1);
        $this->assertTrue(true);
    }

    public function testServiceCanGetRolesFromGroup()
    {
        GroupService::create(1, 'Test', 'Dummy');
        RoleService::create(1, 'Test', 'Dummy');
        GroupService::addRoleToGroup(1,1);

        GroupService::getRolesFromGroup(1,1);
        $this->assertTrue(true);
    }

    public function testServiceCanRemoveRoleFromGroup()
    {
        GroupService::create(1, 'Test', 'Dummy');
        RoleService::create(1, 'Test', 'Dummy');
        GroupService::addRoleToGroup(1,1);

        GroupService::removeRoleFromGroup(1,1);
        $this->assertTrue(true);
    }
}
