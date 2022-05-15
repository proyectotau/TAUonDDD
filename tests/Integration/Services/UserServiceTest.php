<?php

namespace ProyectoTAU\Tests\Integration\Services;

use PHPUnit\Framework\TestCase;
use ProyectoTAU\TAU\Module\Administration\User\Application\UserService;
use ProyectoTAU\TAU\Module\Administration\Group\Application\GroupService;

class UserServiceTest  extends TestCase
{
    use RepositoriesProvider;

    /**
     * @dataProvider userRepositoryProvider
     */
    public function testServiceCanCreateUser($entityManager, $userRepository)
    {
        $this->resetCommandBus($entityManager);
        app()->add('ProyectoTAU\TAU\Module\Administration\User\Domain\UserRepository', $userRepository);
        $userRepository->clear();

        UserService::create(1, 'Test', 'Dummy', 'fakelogin');
        $this->assertTrue(true);
    }

    /**
     * @dataProvider userRepositoryProvider
     */
    public function testServiceCanReadUser($entityManager, $userRepository)
    {
        $this->resetCommandBus($entityManager);
        app()->add('ProyectoTAU\TAU\Module\Administration\User\Domain\UserRepository', $userRepository);
        $userRepository->clear();

        UserService::create(1, 'Test', 'Dummy', 'fakelogin');

        UserService::read(1);
        $this->assertTrue(true);
    }

    /**
     * @dataProvider userRepositoryProvider
     */
    public function testServiceCanUpdateUser($entityManager, $userRepository)
    {
        $this->resetCommandBus($entityManager);
        app()->add('ProyectoTAU\TAU\Module\Administration\User\Domain\UserRepository', $userRepository);
        $userRepository->clear();

        UserService::create(1, 'Test', 'Dummy', 'fakelogin');

        UserService::update(1, 'TestOK', 'DummyOK', 'fakeloginOK');
        $this->assertTrue(true);
    }

    /**
     * @dataProvider userRepositoryProvider
     */
    public function testServiceCanDeleteUser($entityManager, $userRepository)
    {
        $this->resetCommandBus($entityManager);
        app()->add('ProyectoTAU\TAU\Module\Administration\User\Domain\UserRepository', $userRepository);
        $userRepository->clear();

        UserService::create(1, 'Test', 'Dummy', 'fakelogin');

        UserService::delete(1);
        $this->assertTrue(true);
    }

    /**
     * @dataProvider userGroupRepositoriesProvider
     */
    public function testServiceCanAddGroupToUser($entityManager, $userRepository, $groupRepository)
    {
        $this->resetCommandBus($entityManager);
        app()->add('ProyectoTAU\TAU\Module\Administration\User\Domain\UserRepository', $userRepository);
        $userRepository->clear();
        app()->add('ProyectoTAU\TAU\Module\Administration\Group\Domain\GroupRepository', $groupRepository);
        $groupRepository->clear();

        UserService::create(1, 'Test', 'Dummy', 'fakelogin');
        GroupService::create(1, 'Test', 'Dummy');

        UserService::addGroupToUser(1, 1);
        $this->assertTrue(true);
    }

    /**
     * @dataProvider userGroupRepositoriesProvider
     */
    public function testServiceCanGetGroupsFromUser($entityManager, $userRepository, $groupRepository)
    {
        $this->resetCommandBus($entityManager);
        app()->add('ProyectoTAU\TAU\Module\Administration\User\Domain\UserRepository', $userRepository);
        $userRepository->clear();
        app()->add('ProyectoTAU\TAU\Module\Administration\Group\Domain\GroupRepository', $groupRepository);
        $groupRepository->clear();

        UserService::create(1, 'Test', 'Dummy', 'fakelogin');
        GroupService::create(1, 'Test', 'Dummy');

        UserService::getGroupsFromUser(1);
        $this->assertTrue(true);
    }

    /**
     * @dataProvider userGroupRepositoriesProvider
     */
    public function testServiceCanRemoveGroupFromUser($entityManager, $userRepository, $groupRepository)
    {
        $this->resetCommandBus($entityManager);
        app()->add('ProyectoTAU\TAU\Module\Administration\User\Domain\UserRepository', $userRepository);
        $userRepository->clear();
        app()->add('ProyectoTAU\TAU\Module\Administration\Group\Domain\GroupRepository', $groupRepository);
        $groupRepository->clear();

        UserService::create(1, 'Test', 'Dummy', 'fakelogin');
        GroupService::create(1, 'Test', 'Dummy');

        UserService::addGroupToUser(1, 1);
        UserService::getGroupsFromUser(1);

        UserService::removeGroupFromUser(1, 1);
        $this->assertTrue(true);
    }
}
