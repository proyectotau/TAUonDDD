<?php

namespace ProyectoTAU\Tests\Integration\Services;

use PHPUnit\Framework\TestCase;
use ProyectoTAU\TAU\Module\Administration\User\Application\UserService;
use ProyectoTAU\TAU\Module\Administration\Group\Application\GroupService;
use ProyectoTAU\TAU\Module\Administration\Role\Application\RoleService;

class GroupServiceTest  extends TestCase
{
    use RepositoriesProvider;

    /**
     * @dataProvider groupRepositoryProvider
     */
    public function testServiceCanCreateGroup($entityManager, $groupRepository)
    {
        $this->resetCommandBus($entityManager);
        app()->add('ProyectoTAU\TAU\Module\Administration\Group\Domain\GroupRepository', $groupRepository);
        $groupRepository->clear();

        GroupService::create(1, 'Test', 'Dummy');
        $this->assertTrue(true);
    }

    /**
     * @dataProvider groupRepositoryProvider
     */
    public function testServiceCanReadGroup($entityManager, $groupRepository)
    {
        $this->resetCommandBus($entityManager);
        app()->add('ProyectoTAU\TAU\Module\Administration\Group\Domain\GroupRepository', $groupRepository);
        $groupRepository->clear();

        GroupService::create(1, 'Test', 'Dummy');

        GroupService::read(1);
        $this->assertTrue(true);
    }

    /**
     * @dataProvider groupRepositoryProvider
     */
    public function testServiceCanReadAllGroups($entityManager, $groupRepository)
    {
        $this->resetCommandBus($entityManager);
        app()->add('ProyectoTAU\TAU\Module\Administration\Group\Domain\GroupRepository', $groupRepository);
        $groupRepository->clear();

        GroupService::create(1, 'Test', 'Dummy');
        GroupService::create(2, 'Test', 'Dummy');

        GroupService::readAll();
        $this->assertTrue(true);
    }

    /**
     * @dataProvider groupRepositoryProvider
     */
    public function testServiceCanUpdateGroup($entityManager, $groupRepository)
    {
        $this->resetCommandBus($entityManager);
        app()->add('ProyectoTAU\TAU\Module\Administration\Group\Domain\GroupRepository', $groupRepository);
        $groupRepository->clear();

        GroupService::create(1, 'Test', 'Dummy');

        GroupService::update(1, 'TestOK', 'DummyOK');
        $this->assertTrue(true);
    }

    /**
     * @dataProvider groupRepositoryProvider
     */
    public function testServiceCanDeleteGroup($entityManager, $groupRepository)
    {
        $this->resetCommandBus($entityManager);
        app()->add('ProyectoTAU\TAU\Module\Administration\Group\Domain\GroupRepository', $groupRepository);
        $groupRepository->clear();

        GroupService::create(1, 'Test', 'Dummy');

        GroupService::delete(1);
        $this->assertTrue(true);
    }

    /**
     * @dataProvider userGroupRepositoriesProvider
     */
    public function testServiceCanAddUserToGroup($entityManager, $userRepository, $groupRepository)
    {
        $this->resetCommandBus($entityManager);
        app()->add('ProyectoTAU\TAU\Module\Administration\User\Domain\UserRepository', $userRepository);
        $userRepository->clear();
        app()->add('ProyectoTAU\TAU\Module\Administration\Group\Domain\GroupRepository', $groupRepository);
        $groupRepository->clear();

        UserService::create(1, 'Test', 'Dummy', 'fakelogin');
        GroupService::create(1, 'Test', 'Dummy');

        GroupService::addUserToGroup(1, 1);
        $this->assertTrue(true);
    }

    /**
     * @dataProvider userGroupRepositoriesProvider
     */
    public function testServiceCanGetUsersFromGroup($entityManager, $userRepository, $groupRepository)
    {
        $this->resetCommandBus($entityManager);
        app()->add('ProyectoTAU\TAU\Module\Administration\User\Domain\UserRepository', $userRepository);
        $userRepository->clear();
        app()->add('ProyectoTAU\TAU\Module\Administration\Group\Domain\GroupRepository', $groupRepository);
        $groupRepository->clear();

        UserService::create(1, 'Test', 'Dummy', 'fakelogin');
        GroupService::create(1, 'Test', 'Dummy');
        GroupService::addUserToGroup(1, 1);

        GroupService::getUsersFromGroup(1, 1);
        $this->assertTrue(true);
    }

    /**
     * @dataProvider userGroupRepositoriesProvider
     */
    public function testServiceCanRemoveUserFromGroup($entityManager, $userRepository, $groupRepository)
    {
        $this->resetCommandBus($entityManager);
        app()->add('ProyectoTAU\TAU\Module\Administration\User\Domain\UserRepository', $userRepository);
        $userRepository->clear();
        app()->add('ProyectoTAU\TAU\Module\Administration\Group\Domain\GroupRepository', $groupRepository);
        $groupRepository->clear();

        UserService::create(1, 'Test', 'Dummy', 'fakelogin');
        GroupService::create(1, 'Test', 'Dummy');
        GroupService::addUserToGroup(1, 1);

        GroupService::removeUserFromGroup(1, 1);
        $this->assertTrue(true);
    }

    /**
     * @dataProvider groupRoleRepositoriesProvider
     */
    public function testServiceCanAddRoleToGroup($entityManager, $groupRepository, $roleRepository)
    {
        $this->resetCommandBus($entityManager);
        app()->add('ProyectoTAU\TAU\Module\Administration\Group\Domain\GroupRepository', $groupRepository);
        $groupRepository->clear();
        app()->add('ProyectoTAU\TAU\Module\Administration\Role\Domain\RoleRepository', $roleRepository);
        $roleRepository->clear();

        GroupService::create(1, 'Test', 'Dummy');
        RoleService::create(1, 'Test', 'Dummy');

        GroupService::addRoleToGroup(1,1);
        $this->assertTrue(true);
    }

    /**
     * @dataProvider groupRoleRepositoriesProvider
     */
    public function testServiceCanGetRolesFromGroup($entityManager, $groupRepository, $roleRepository)
    {
        $this->resetCommandBus($entityManager);
        app()->add('ProyectoTAU\TAU\Module\Administration\Group\Domain\GroupRepository', $groupRepository);
        $groupRepository->clear();
        app()->add('ProyectoTAU\TAU\Module\Administration\Role\Domain\RoleRepository', $roleRepository);
        $roleRepository->clear();

        GroupService::create(1, 'Test', 'Dummy');
        RoleService::create(1, 'Test', 'Dummy');
        GroupService::addRoleToGroup(1,1);

        GroupService::getRolesFromGroup(1,1);
        $this->assertTrue(true);
    }

    /**
     * @dataProvider groupRoleRepositoriesProvider
     */
    public function testServiceCanRemoveRoleFromGroup($entityManager, $groupRepository, $roleRepository)
    {
        $this->resetCommandBus($entityManager);
        app()->add('ProyectoTAU\TAU\Module\Administration\Group\Domain\GroupRepository', $groupRepository);
        $groupRepository->clear();
        app()->add('ProyectoTAU\TAU\Module\Administration\Role\Domain\RoleRepository', $roleRepository);
        $roleRepository->clear();

        GroupService::create(1, 'Test', 'Dummy');
        RoleService::create(1, 'Test', 'Dummy');
        GroupService::addRoleToGroup(1,1);

        GroupService::removeRoleFromGroup(1,1);
        $this->assertTrue(true);
    }
}
