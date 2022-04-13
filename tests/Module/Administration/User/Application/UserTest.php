<?php

namespace Tests\Module\Administration\User\Application;

use Mockery;
use PHPUnit\Framework\TestCase;
use ProyectoTAU\TAU\Common\InMemoryRepository;
use ProyectoTAU\TAU\Module\Administration\User\Application\delete\DeleteUserCommand;
use ProyectoTAU\TAU\Module\Administration\User\Application\delete\DeleteUserCommandHandler;
use ProyectoTAU\TAU\Module\Administration\User\Application\read\ReadUserCommand;
use ProyectoTAU\TAU\Module\Administration\User\Application\read\ReadUserCommandHandler;
use ProyectoTAU\TAU\Module\Administration\User\Application\update\UpdateUserCommand;
use ProyectoTAU\TAU\Module\Administration\User\Application\update\UpdateUserCommandHandler;
use ProyectoTAU\TAU\Module\Administration\User\Application\UserService;
use ProyectoTAU\TAU\Module\Administration\User\Domain\User;
use ProyectoTAU\TAU\Module\Administration\Group\Domain\Group;
use ProyectoTAU\TAU\Module\Administration\User\Domain\UserRepository;
use ProyectoTAU\TAU\Module\Administration\User\Application\create\CreateUser;
use ProyectoTAU\TAU\Module\Administration\User\Application\read\ReadUser;
use ProyectoTAU\TAU\Module\Administration\User\Application\update\UpdateUser;
use ProyectoTAU\TAU\Module\Administration\User\Application\delete\DeleteUser;

use ProyectoTAU\TAU\Module\Administration\User\Application\create\CreateUserCommandHandler;
use ProyectoTAU\TAU\Module\Administration\User\Application\create\CreateUserCommand;

class DummyUserRepository implements UserRepository {

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

        return new User(0, 'Test', 'Dummy', 'fakelogin');
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
    public function getGroupsFromUser(User $user):array {return [];}
}

final class UserTest extends TestCase {
    public function mockeryTestTearDown()
    {
        Mockery::close();
    }

	public function testItCanCreateAdminUser()
    {
        InMemoryRepository::getInstance()->clear();

        $userRepository = Mockery::mock(DummyUserRepository::class);
        app()->add('ProyectoTAU\TAU\Module\Administration\User\Domain\UserRepository', $userRepository);

        $userRepository->shouldReceive('create')
            ->once()
            ->with(\Hamcrest\Core\IsEqual::equalTo(
                new User(0, "Test", "Dummy", "fakelogin")));

        // Mi primera alternativa orignal. Sin CommandBus, pero se inyesta el Repo via Service Provider
        // En create se invoca directamente al Handler adecuado pasado los arg en su Command
        //$user = new CreateUser($userRepository);
        //$user->create(0, "Test", "Dummy", "fakelogin"); // TODO remove
        //UserService::create(0, "Test", "Dummy", "fakelogin");

        // Alternativa de CodelyTV. Sin CommandBus, ni mapeo entre el Command y su Handler.
        //Se inyecta el Repo en el Handler y se le pasa los arg en su Command como DTO.
        $handler = new CreateUserCommandHandler($userRepository);
        $handler->handle(new CreateUserCommand(0, "Test", "Dummy", "fakelogin"));
	}

    public function testItCanReadAdminUser()
    {
        InMemoryRepository::getInstance()->clear();

        $userRepository = Mockery::mock(DummyUserRepository::class);

        $userRepository->shouldReceive('read')->once()->with(0);

        //$user = new ReadUser($userRepository);
        //$user->read(0);

        $handler = new ReadUserCommandHandler($userRepository);
        $handler->handle(new ReadUserCommand(0));
    }

    public function testItCanUpdateAdminUser()
    {
        InMemoryRepository::getInstance()->clear();

        $userRepository = Mockery::mock(DummyUserRepository::class);

        $userRepository->shouldReceive('update')->once()->with(0, "Test", "Dummy", "fakelogin");

        //$user = new UpdateUser($userRepository);
        //$user->update(0, "Test", "Dummy", "fakelogin");
        //UserService::update(0, "Test", "Dummy", "fakelogin");

        $handler = new UpdateUserCommandHandler($userRepository);
        $handler->handle(new UpdateUserCommand(0, "Test", "Dummy", "fakelogin"));
    }

    public function testItCanDeleteAdminUser()
    {
        InMemoryRepository::getInstance()->clear();

        $userRepository = Mockery::mock(DummyUserRepository::class);

        $userRepository->shouldReceive('delete')->once()->with(0);

        //$user = new DeleteUser($userRepository);
        //$user->delete(0);
        //UserService::delete(0);

        $handler = new DeleteUserCommandHandler($userRepository);
        $handler->handle(new DeleteUserCommand(0));
    }
}
