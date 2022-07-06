<?php

namespace ProyectoTAU\Tests\Module\Administration\User\Application;

use Mockery;
use Mockery\Adapter\Phpunit\MockeryTestCase;
use ProyectoTAU\TAU\Module\Administration\User\Application\readAll\ReadAllUsersCommand;
use ProyectoTAU\TAU\Module\Administration\User\Application\readAll\ReadAllUsersCommandHandler;
use ProyectoTAU\TAU\Module\Administration\User\Domain\User;
use ProyectoTAU\TAU\Module\Administration\Group\Domain\Group;
use ProyectoTAU\TAU\Module\Administration\User\Domain\UserRepository;
use ProyectoTAU\TAU\Module\Administration\User\Application\UserService;
use ProyectoTAU\TAU\Module\Administration\User\Application\create\CreateUserCommand;
use ProyectoTAU\TAU\Module\Administration\User\Application\create\CreateUserCommandHandler;
use ProyectoTAU\TAU\Module\Administration\User\Application\read\ReadUserCommand;
use ProyectoTAU\TAU\Module\Administration\User\Application\read\ReadUserCommandHandler;
use ProyectoTAU\TAU\Module\Administration\User\Application\update\UpdateUserCommand;
use ProyectoTAU\TAU\Module\Administration\User\Application\update\UpdateUserCommandHandler;
use ProyectoTAU\TAU\Module\Administration\User\Application\delete\DeleteUserCommand;
use ProyectoTAU\TAU\Module\Administration\User\Application\delete\DeleteUserCommandHandler;


class DummyUserRepository implements UserRepository {

    public function clear(): void {}

    public function create(User $user): void
    {
        // Should receive a call once with the same Dummy User as argument
        if( ! ($user->getId() === 0 &&
               $user->getName() === 'Test' &&
               $user->getSurname() === 'Dummy' &&
               $user->getLogin() === 'fakelogin') )
            throw new \InvalidArgumentException("Mismatched User received by create method");
    }

    public function read($id): User
    {
        // Should receive a call with id === 0
        if( ! ($id === 0) ) {
            throw new \InvalidArgumentException("Mismatched User received by read method");
        }

        return new User(0,null,null, null);
    }

    public function readAll(): array
    {
        return [
            new User(0,null,null, null),
            new User(1,null,null, null)
        ];
    }

    public function update($id, $name, $surname, $login): void
    {
        // Should receive a call once with the same Dummy User as argument
        if( ! ($id === 0 &&
            $name === 'Test' &&
            $surname === 'Dummy' &&
            $login === 'fakelogin') )
            throw new \InvalidArgumentException("Mismatched User received by update method");
    }

    public function delete($id): void
    {
        // Should receive a call with id === 0
        if( ! ($id === 0) ) {
            throw new \InvalidArgumentException("Mismatched User received by delete method");
        }
    }

    public function addGroupToUser(Group $group, User $user): void {}
    public function removeGroupFromUser(Group $group, User $user): void {}
    public function getGroupsFromUser(User $user):array {return [];}
}

final class UserTest extends MockeryTestCase {
    public function mockeryTestTearDown()
    {
        Mockery::close();
    }

	public function testItCanCreateAdminUser()
    {
        $userRepository = Mockery::mock(DummyUserRepository::class);

        $userRepository->shouldReceive('create')
            ->once()
            ->with(\Hamcrest\Core\IsEqual::equalTo(
                new User(0, "Test", "Dummy", "fakelogin")));

        //UserService::create(0, "Test", "Dummy", "fakelogin");

        $handler = new CreateUserCommandHandler($userRepository);
        $handler->handle(new CreateUserCommand(0, "Test", "Dummy", "fakelogin"));
	}

    public function testItCanReadAdminUser()
    {
        $userRepository = Mockery::mock(DummyUserRepository::class);

        $userRepository->shouldReceive('read')->once()->with(0);

        //UserService::read(0);

        $handler = new ReadUserCommandHandler($userRepository);
        $handler->handle(new ReadUserCommand(0));
    }

    public function testItCanReadAllAdminUsers()
    {
        $userRepository = Mockery::mock(DummyUserRepository::class);

        $userRepository->shouldReceive('readAll')->once();

        //UserService::readAll();

        $handler = new ReadAllUsersCommandHandler($userRepository);
        $handler->handle(new ReadAllUsersCommand());
    }

    public function testItCanUpdateAdminUser()
    {
        $userRepository = Mockery::mock(DummyUserRepository::class);

        $userRepository->shouldReceive('update')->once()->with(0, "Test", "Dummy", "fakelogin");

        //UserService::update(0, "Test", "Dummy", "fakelogin");

        $handler = new UpdateUserCommandHandler($userRepository);
        $handler->handle(new UpdateUserCommand(0, "Test", "Dummy", "fakelogin"));
    }

    public function testItCanDeleteAdminUser()
    {
        $userRepository = Mockery::mock(DummyUserRepository::class);

        $userRepository->shouldReceive('delete')->once()->with(0);

        //UserService::delete(0);

        $handler = new DeleteUserCommandHandler($userRepository);
        $handler->handle(new DeleteUserCommand(0));
    }
}
