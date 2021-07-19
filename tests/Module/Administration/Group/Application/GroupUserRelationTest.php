<?php

namespace Tests\Module\Administration\Group\Application;

use PHPUnit\Framework\TestCase;
use ProyectoTAU\TAU\Common\InMemoryRepository;
use ProyectoTAU\TAU\Module\Administration\User\Infrastructure\InMemoryUserRepository;
use ProyectoTAU\TAU\Module\Administration\Group\Infrastructure\InMemoryGroupRepository;
use ProyectoTAU\TAU\Module\Administration\Group\Application\addUserToGroup\AddUserToGroup;
use ProyectoTAU\TAU\Module\Administration\Group\Application\getUsersFromGroup\GetUsersFromGroup;

use ProyectoTAU\TAU\Module\Administration\User\Domain\User;
use ProyectoTAU\TAU\Module\Administration\Group\Domain\Group;

class GroupUserRelationTest extends TestCase
{
    public function testItCanAddUserToGroup()
    {
        InMemoryRepository::getInstance()->clear();

        $userRepository = new InMemoryUserRepository();
        $groupRepository = new InMemoryGroupRepository();

        $userRepository->create($user = new User(0, "Test", "Dummy", "fakelogin"));
        $groupRepository->create($group = new Group(0, "Test", "Dummy"));

        $addUserToGroupService = new AddUserToGroup($userRepository, $groupRepository);
        $addUserToGroupService->addUserToGroup(0, 0);

        $actual = InMemoryRepository::getInstance()->getUsersFromGroup($group);

        $this->assertSame([
            'members' => [
                            $user
                         ],
            'available' => []
        ], $actual);
    }

    public function testItCanGetUsersFromGroup()
    {
        InMemoryRepository::getInstance()->clear();

        $userRepository = new InMemoryUserRepository();
        $groupRepository = new InMemoryGroupRepository();

        $userRepository->create($user = new User(0, "Test", "Dummy", "fakelogin"));
        $groupRepository->create($group = new Group(0, "Test", "Dummy"));

        InMemoryRepository::getInstance()->addUserToGroup($user, $group);

        $getUsersFromGroupService = new GetUsersFromGroup($groupRepository);
        $actual = $getUsersFromGroupService->getUsersFromGroup(0);

        $this->assertSame([
            'members' => [
                            $user
                         ],
            'available' => []
        ], $actual);
    }
}
