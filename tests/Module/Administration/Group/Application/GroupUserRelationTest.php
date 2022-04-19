<?php

namespace ProyectoTAU\Tests\Module\Administration\Group\Application;

use PHPUnit\Framework\TestCase;
use ProyectoTAU\TAU\Common\InMemoryRepository;
use ProyectoTAU\TAU\Module\Administration\User\Infrastructure\InMemoryUserRepository;
use ProyectoTAU\TAU\Module\Administration\Group\Infrastructure\InMemoryGroupRepository;
use ProyectoTAU\TAU\Module\Administration\User\Domain\User;
use ProyectoTAU\TAU\Module\Administration\Group\Domain\Group;
use ProyectoTAU\TAU\Module\Administration\User\Application\addGroupToUser\AddGroupToUserCommand;
use ProyectoTAU\TAU\Module\Administration\User\Application\addGroupToUser\AddGroupToUserCommandHandler;
use ProyectoTAU\TAU\Module\Administration\User\Application\getGroupsFromUser\GetGroupsFromUserCommand;
use ProyectoTAU\TAU\Module\Administration\User\Application\getGroupsFromUser\GetGroupsFromUserCommandHandler;
use ProyectoTAU\TAU\Module\Administration\User\Application\removeGroupFromUser\RemoveGroupFromUserCommand;
use ProyectoTAU\TAU\Module\Administration\User\Application\removeGroupFromUser\RemoveGroupFromUserCommandHandler;
use ProyectoTAU\TAU\Module\Administration\User\Application\UserService;

class GroupUserRelationTest extends TestCase
{
    public function testItCanAddGroupToUser()
    {
        InMemoryRepository::getInstance()->clear();

        $userRepository = new InMemoryUserRepository();
        $groupRepository = new InMemoryGroupRepository();

        $userRepository->create($user = new User(0, "Test", "Dummy", "fakelogin"));
        $groupRepository->create($group = new Group(0, "Test", "Dummy"));

        //UserService::addGroupToUser(0, 0);

        $handler = new AddGroupToUserCommandHandler($groupRepository, $userRepository);
        $handler->handle(new AddGroupToUserCommand(0, 0) );

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

        InMemoryRepository::getInstance()->addUserToGroup($user, $group);

        //$actual = UserService::getGroupsFromUser(0);

        $handler = new GetGroupsFromUserCommandHandler($userRepository);
        $actual = $handler->handle(new GetGroupsFromUserCommand(0));

        $this->assertSame([
            'belongsto' => [
                            $group
                         ],
            'available' => []
        ], $actual);
    }

    public function testItCanRemoveGroupFromUser()
    {
        InMemoryRepository::getInstance()->clear();

        $userRepository = new InMemoryUserRepository();
        $groupRepository = new InMemoryGroupRepository();

        $userRepository->create($user = new User(0, "Test", "Dummy", "fakelogin"));
        $groupRepository->create($group = new Group(0, "Test", "Dummy"));

        //UserService::removeGroupFromUser(0, 0);

        $handler = new RemoveGroupFromUserCommandHandler($groupRepository, $userRepository);
        $handler->handle(new RemoveGroupFromUserCommand(0, 0));

        $actual = InMemoryRepository::getInstance()->getGroupsFromUser($user);

            $this->assertSame([
            'belongsto' => [],
            'available' => [
                $group
            ]
        ], $actual);
    }
}
