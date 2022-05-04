<?php

namespace ProyectoTAU\Tests\Module\Administration\User\Application;

use PHPUnit\Framework\TestCase;
use ProyectoTAU\TAU\Common\AssertsArraySubset;
use ProyectoTAU\TAU\Module\Administration\User\Domain\User;
use ProyectoTAU\TAU\Module\Administration\Group\Domain\Group;
use ProyectoTAU\TAU\Module\Administration\Group\Application\addUserToGroup\AddUserToGroupCommand;
use ProyectoTAU\TAU\Module\Administration\Group\Application\addUserToGroup\AddUserToGroupCommandHandler;
use ProyectoTAU\TAU\Module\Administration\Group\Application\getUsersFromGroup\GetUsersFromGroupCommand;
use ProyectoTAU\TAU\Module\Administration\Group\Application\getUsersFromGroup\GetUsersFromGroupCommandHandler;
use ProyectoTAU\TAU\Module\Administration\Group\Application\removeUserFromGroup\RemoveUserFromGroupCommand;
use ProyectoTAU\TAU\Module\Administration\Group\Application\removeUserFromGroup\RemoveUserFromGroupCommandHandler;
use ProyectoTAU\TAU\Module\Administration\Group\Application\GroupService;

class UserGroupRelationTest extends TestCase
{
    use AssertsArraySubset;

    /**
     * @dataProvider availableUsersProvider
     */
    public function testItCanAddUserToGroup($users, $groups, $relations, $available)
    {
        // arrange
        $userRepository = app()->get('ProyectoTAU\TAU\Module\Administration\User\Domain\UserRepository');
        $userRepository->clear();
        $groupRepository = app()->get('ProyectoTAU\TAU\Module\Administration\Group\Domain\GroupRepository');
        $groupRepository->clear();

        foreach ($users as $user) {
            $userRepository->create($user);
        }

        foreach ($groups as $group) {
            $groupRepository->create($group);
        }

        $expected = [
            'members' => [],
            'available' => []
        ];

        foreach ($available as $group) {
            $expected['available'][$group->getId()] = $group;
        }

        $handler = new AddUserToGroupCommandHandler($userRepository, $groupRepository);

        // act
        foreach ($relations as $pair) {
            //GroupService::addUserToGroup($pair[0]->getId(), $pair[1]->getId()); // (user,group) pair
            $handler->handle(new AddUserToGroupCommand($pair[0]->getId(), $pair[1]->getId()));
            $expected['members'][$pair[0]->getId()] = $pair[0];
        }

        // assert
        $actual = $groupRepository->getUsersFromGroup($groups[0]);

        $message = '';
        $result = $this->AssertsArrayIsASubsetOf($expected, $actual, $message);
        $this->assertTrue($result, $message);
    }

    /**
     * @dataProvider availableUsersProvider
     */
    public function testItCanGetUsersFromGroup($users, $groups, $relations, $available)
    {
        // arrange
        $userRepository = app()->get('ProyectoTAU\TAU\Module\Administration\User\Domain\UserRepository');
        $userRepository->clear();
        $groupRepository = app()->get('ProyectoTAU\TAU\Module\Administration\Group\Domain\GroupRepository');
        $groupRepository->clear();

        foreach ($users as $user) {
            $userRepository->create($user);
        }

        foreach ($groups as $group) {
            $groupRepository->create($group);
        }

        $expected = [
            'members' => [],
            'available' => []
        ];

        foreach ($available as $user)
            $expected['available'][$user->getId()] = $user;

        foreach ($relations as $pair) {
            $groupRepository->addUserToGroup($pair[0], $pair[1]); // (x,y) pair
            $expected['members'][$pair[0]->getId()] = $pair[0];
        }

        $handler = new GetUsersFromGroupCommandHandler($groupRepository);

        // act
        //$actual = GroupService::getUsersFromGroup($groups[0]->getId());
        $actual = $handler->handle(new GetUsersFromGroupCommand($groups[0]->getId()));

        // assert
        $message = '';
        $result = $this->AssertsArrayIsASubsetOf($expected, $actual, $message);
        $this->assertTrue($result, $message);
    }

    public function testICanRemoveUserFromGroup()
    {
        // arrange
        $userRepository = app()->get('ProyectoTAU\TAU\Module\Administration\User\Domain\UserRepository');
        $userRepository->clear();
        $groupRepository = app()->get('ProyectoTAU\TAU\Module\Administration\Group\Domain\GroupRepository');
        $groupRepository->clear();

        $userRepository->create($user = new User(1, "Test1", "Dummy1", "fakelogin1"));
        $groupRepository->create($group = new Group(1, "Test1", "Dummy1"));

        $groupRepository->addUserToGroup($user, $group);

        $expected = [
            'members' => [],
            'available' => [
               $user->getId() => $user
            ]
        ];

        $handler = new RemoveUserFromGroupCommandHandler($userRepository, $groupRepository);

        // act
        //GroupService::removeUserFromGroup($user->getId(), $group->getId());
        $handler->handle(new RemoveUserFromGroupCommand($user->getId(), $group->getId()));

        // assert
        $actual = $groupRepository->getUsersFromGroup($group);
        $message = '';
        $result = $this->AssertsArrayIsASubsetOf($expected, $actual, $message);
        $this->assertTrue($result, $message);
    }

    /*
     * Providers
     */
    public function availableGroupsProvider(): array //TODO unused
    {
        $user1 = new User(1, "Test1", "Dummy1", "fakelogin1");

        $group1 = new Group(1, "Test1", "Dummy1");
        $group2 = new Group(2, "Test2", "Dummy2");
        $group3 = new Group(3, "Test3", "Dummy3");

        $users = [$user1];
        $groups = [$group1, $group2, $group3];

        return array(
            "User 1 belongs to none group at all, all groups available" =>
            array($users, $groups, [
            ], [
                $group1,
                $group2,
                $group3
            ]),
            "User 1 belongs to group 1 only, groups 2 and 3 available" =>
            array($users, $groups, [
                [$user1, $group1]
            ], [
                $group2,
                $group3
            ]),
            "User 1 belongs to groups 1 and 2, group 3 available" =>
            array($users, $groups, [
                [$user1, $group1],
                [$user1, $group2]
            ], [
                $group3
            ]),
            "User 1 belongs to all 3 groups, 0 groups available" =>
            array($users, $groups, [
                [$user1, $group1],
                [$user1, $group2],
                [$user1, $group3]
            ], [
            ])
        );
    }

    public function availableUsersProvider(): array
    {
        $user1 = new User(1, "Test1", "Dummy1", "fakelogin1");
        $user2 = new User(2, "Test2", "Dummy2", "fakelogin2");
        $user3 = new User(3, "Test3", "Dummy3", "fakelogin3");

        $group1 = new Group(1, "Test1", "Dummy1");

        $users = [$user1, $user2, $user3];
        $groups = [$group1];

        return array(
            "None user is member of group 1, all users available" =>
                array($users, $groups, [

                ], [
                    $user1,
                    $user2,
                    $user3,
                ]),
            "Only user 1 is member of group 1, users 2 and 3 available" =>
                array($users, $groups, [
                    [$user1, $group1]
                ], [
                    $user2,
                    $user3,
                ]),
            "Users 1 and 2 are member of group 1, user 3 available" =>
                array($users, $groups, [
                    [$user1, $group1],
                    [$user2, $group1],
                ], [
                    $user3
                ]),
            "All users are member of group 1, 0 users available" =>
                array($users, $groups, [
                    [$user1, $group1],
                    [$user2, $group1],
                    [$user3, $group1]
                ], [

                ])
        );
    }
}
