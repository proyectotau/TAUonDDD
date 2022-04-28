<?php

namespace ProyectoTAU\Tests\Module\Administration\Group\Application;

use PHPUnit\Framework\TestCase;
use ProyectoTAU\TAU\Common\AssertsArraySubset;
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
    use AssertsArraySubset;

    public function testItCanAddGroupToUser()
    {
        $userRepository = app()->get('ProyectoTAU\TAU\Module\Administration\User\Domain\UserRepository');
        $userRepository->clear();
        $groupRepository = app()->get('ProyectoTAU\TAU\Module\Administration\Group\Domain\GroupRepository');
        $groupRepository->clear();

        $userRepository->create($user = new User(0, "Test", "Dummy", "fakelogin"));
        $groupRepository->create($group = new Group(0, "Test", "Dummy"));

        //UserService::addGroupToUser(0, 0);

        $handler = new AddGroupToUserCommandHandler($groupRepository, $userRepository);
        $handler->handle(new AddGroupToUserCommand(0, 0) );

        $actual = $userRepository->getGroupsFromUser($user);

        $expected = [
            'belongsto' => [
                $group
            ],
            'available' => []
        ];
        $message = '';
        $result = $this->AssertsArrayIsASubsetOf($expected, $actual, $message);
        $this->assertTrue($result, $message);
    }

    public function testItCanGetGroupsFromUser()
    {
        $userRepository = app()->get('ProyectoTAU\TAU\Module\Administration\User\Domain\UserRepository');
        $userRepository->clear();
        $groupRepository = app()->get('ProyectoTAU\TAU\Module\Administration\Group\Domain\GroupRepository');
        $groupRepository->clear();

        $userRepository->create($user = new User(0, "Test", "Dummy", "fakelogin"));
        $groupRepository->create($group = new Group(0, "Test", "Dummy"));

        $groupRepository->addUserToGroup($user, $group);

        //$actual = UserService::getGroupsFromUser(0);

        $handler = new GetGroupsFromUserCommandHandler($userRepository);
        $actual = $handler->handle(new GetGroupsFromUserCommand(0));

        $expected = [
            'belongsto' => [
                $group
            ],
            'available' => []
        ];
        $message = '';
        $result = $this->AssertsArrayIsASubsetOf($expected, $actual, $message);
        $this->assertTrue($result, $message);
    }

    public function testItCanRemoveGroupFromUser()
    {
        $userRepository = app()->get('ProyectoTAU\TAU\Module\Administration\User\Domain\UserRepository');
        $userRepository->clear();
        $groupRepository = app()->get('ProyectoTAU\TAU\Module\Administration\Group\Domain\GroupRepository');
        $groupRepository->clear();

        $userRepository->create($user = new User(0, "Test", "Dummy", "fakelogin"));
        $groupRepository->create($group = new Group(0, "Test", "Dummy"));

        //UserService::removeGroupFromUser(0, 0);

        $handler = new RemoveGroupFromUserCommandHandler($groupRepository, $userRepository);
        $handler->handle(new RemoveGroupFromUserCommand(0, 0));

        $actual = $userRepository->getGroupsFromUser($user);

        $expected = [
            'belongsto' => [],
            'available' => [
                $group
            ]
        ];
        $message = '';
        $result = $this->AssertsArrayIsASubsetOf($expected, $actual, $message);
        $this->assertTrue($result, $message);
    }
}
