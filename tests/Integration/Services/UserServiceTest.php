<?php

namespace ProyectoTAU\Tests\Integration\Services;

use PHPUnit\Framework\TestCase;
use ProyectoTAU\TAU\Module\Administration\User\Application\UserService;
use ProyectoTAU\TAU\Module\Administration\Group\Application\GroupService;

class UserServiceTest  extends TestCase
{
    public function setUp(): void
    {
        $em = app()->get('EntityManager');
        $em->clearUser();
        $em->clearGroup();
    }

    public function testServiceCanCreateUser()
    {
        UserService::create(1, 'Test', 'Dummy', 'fakelogin');
        $this->assertTrue(true);
    }

    public function testServiceCanReadUser()
    {
        UserService::create(1, 'Test', 'Dummy', 'fakelogin');

        UserService::read(1);
        $this->assertTrue(true);
    }

    public function testServiceCanUpdateUser()
    {
        UserService::create(1, 'Test', 'Dummy', 'fakelogin');

        UserService::update(1, 'TestOK', 'DummyOK', 'fakeloginOK');
        $this->assertTrue(true);
    }

    public function testServiceCanDeleteUser()
    {
        UserService::create(1, 'Test', 'Dummy', 'fakelogin');

        UserService::delete(1);
        $this->assertTrue(true);
    }

    public function testServiceCanAddGroupToUser()
    {
        UserService::create(1, 'Test', 'Dummy', 'fakelogin');
        GroupService::create(1, 'Test', 'Dummy');

        UserService::addGroupToUser(1, 1);
        $this->assertTrue(true);
    }

    public function testServiceCanGetGroupsFromUser()
    {
        UserService::create(1, 'Test', 'Dummy', 'fakelogin');
        GroupService::create(1, 'Test', 'Dummy');

        UserService::getGroupsFromUser(1, 1);
        $this->assertTrue(true);
    }

    public function testServiceCanRemoveGroupFromUser()
    {
        UserService::create(1, 'Test', 'Dummy', 'fakelogin');
        GroupService::create(1, 'Test', 'Dummy');

        UserService::addGroupToUser(1, 1);

        UserService::removeGroupFromUser(1, 1);
        $this->assertTrue(true);
    }
}
