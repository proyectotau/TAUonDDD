<?php

namespace ProyectoTAU\Tests\Module\Administration\Group\Application;

use PHPUnit\Framework\TestCase;
use ProyectoTAU\TAU\Common\InMemoryRepository;
use ProyectoTAU\TAU\Module\Administration\User\Infrastructure\InMemoryUserRepository;
use ProyectoTAU\TAU\Module\Administration\Group\Infrastructure\InMemoryGroupRepository;
use ProyectoTAU\TAU\Module\Administration\Group\Application\GroupService;
use ProyectoTAU\TAU\Module\Administration\User\Application\UserService;
use ProyectoTAU\TAU\Module\Administration\Group\Application\addUserToGroup\AddUserToGroupCommand;
use ProyectoTAU\TAU\Module\Administration\Group\Application\addUserToGroup\AddUserToGroupCommandHandler;
use ProyectoTAU\TAU\Module\Administration\Group\Application\getUsersFromGroup\GetUsersFromGroupCommand;
use ProyectoTAU\TAU\Module\Administration\Group\Application\getUsersFromGroup\GetUsersFromGroupCommandHandler;
use ProyectoTAU\TAU\Module\Administration\User\Application\getGroupsFromUser\GetGroupsFromUserCommand;
use ProyectoTAU\TAU\Module\Administration\User\Application\getGroupsFromUser\GetGroupsFromUserCommandHandler;

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

        //$addUserToGroupService = new AddUserToGroup($userRepository, $groupRepository);
        //$addUserToGroupService->addUserToGroup(0, 0);
        GroupService::addUserToGroup(0, 0);

        //$handler = new AddUserToGroupCommandHandler($userRepository, $groupRepository);
        //$handler->handle(new AddUserToGroupCommand(0, 0) );

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

        //$getUsersFromGroupService = new GetUsersFromGroup($groupRepository);
        //$actual = $getUsersFromGroupService->getUsersFromGroup(0);
        $actual = GroupService::getUsersFromGroup(0);

        //$handler = new GetUsersFromGroupCommandHandler($groupRepository);
        //$actual = $handler->handle(new GetUsersFromGroupCommand(0));

        $this->assertSame([
            'members' => [
                            $user
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

        //$getUsersFromGroupService = new GetGroupsFromUser($userRepository);
        //$actual = $getUsersFromGroupService->getGroupsFromUser(0);
        $actual = UserService::getGroupsFromUser(0);

        //$handler = new GetGroupsFromUserCommandHandler($userRepository);
        //$actual = $handler->handle(new GetGroupsFromUserCommand(0));

        $this->assertSame([
            'belongsto' => [
                1 => $group1
            ],
            'available' => [
                2 => $group2
            ]
        ], $actual);
    }
}
