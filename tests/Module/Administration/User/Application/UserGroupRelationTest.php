<?php

namespace Tests\Module\Administration\User\Application;

use PHPUnit\Framework\TestCase;
use ProyectoTAU\TAU\Common\InMemoryRepository;
use ProyectoTAU\TAU\Module\Administration\User\Infrastructure\InMemoryUserRepository;
use ProyectoTAU\TAU\Module\Administration\Group\Infrastructure\InMemoryGroupRepository;
use ProyectoTAU\TAU\Module\Administration\User\Application\addGroupToUser\AddGroupToUser;
use ProyectoTAU\TAU\Module\Administration\User\Application\getGroupsFromUser\GetGroupsFromUser;

use ProyectoTAU\TAU\Module\Administration\User\Domain\User;
use ProyectoTAU\TAU\Module\Administration\Group\Domain\Group;

class UserGroupRelationTest extends TestCase
{
    public function testItCanAddGroupToUser()
    {
        InMemoryRepository::getInstance()->clear();

        $userRepository = new InMemoryUserRepository();
        $groupRepository = new InMemoryGroupRepository();

        $userRepository->create($user = new User(0, "Test", "Dummy", "fakelogin"));
        $groupRepository->create($group = new Group(0, "Test", "Dummy"));

        $addGroupToUserService = new AddGroupToUser($groupRepository, $userRepository);
        $addGroupToUserService->addGroupToUser(0, 0);

        $actual = InMemoryRepository::getInstance()->getGroupsFromUser($user);

        $this->assertSame([
            'belongsto' => [
                            $group
                           ],
            'available' => []
        ], $actual);
    }

    public function testItCanGetGroupsFromUser()
    {
        InMemoryRepository::getInstance()->clear();

        $userRepository = new InMemoryUserRepository();
        $groupRepository = new InMemoryGroupRepository();

        $userRepository->create($user = new User(0, "Test", "Dummy", "fakelogin"));
        $groupRepository->create($group = new Group(0, "Test", "Dummy"));

        InMemoryRepository::getInstance()->addGroupToUser($group, $user);

        $getUsersFromGroupService = new GetGroupsFromUser($userRepository);
        $actual = $getUsersFromGroupService->getGroupsFromUser(0);

        $this->assertSame([
            'belongsto' => [
                            $group
                           ],
            'available' => []
        ], $actual);
    }

    public function testItCanGetAvailableGroupsFromUser()
    {
        InMemoryRepository::getInstance()->clear();

        $userRepository = new InMemoryUserRepository();
        $groupRepository = new InMemoryGroupRepository();

        $userRepository->create($user = new User(0, "Test", "Dummy", "fakelogin"));
        $groupRepository->create($group1 = new Group(1, "Test1", "Dummy1"));
        $groupRepository->create($group2 = new Group(2, "Test2", "Dummy2"));

        InMemoryRepository::getInstance()->addUserToGroup($user, $group1);

        $getUsersFromGroupService = new GetGroupsFromUser($userRepository);
        $actual = $getUsersFromGroupService->getGroupsFromUser(0);

        $this->assertSame([
            'belongsto' => [
                $group1
            ],
            'available' => [
                $group2
            ]
        ], $actual);
    }
}
