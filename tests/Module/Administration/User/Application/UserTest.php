<?php

use ProyectoTAU\TAU\Common\InMemoryRepository;
use Mockery\Adapter\Phpunit\MockeryTestCase as TestCase;
use ProyectoTAU\TAU\Module\Administration\User\Domain\User;
use ProyectoTAU\TAU\Module\Administration\Group\Domain\Group;
use ProyectoTAU\TAU\Module\Administration\User\Domain\UserRepository;
use ProyectoTAU\TAU\Module\Administration\User\Application\create\CreateUser;
use ProyectoTAU\TAU\Module\Administration\User\Application\read\ReadUser;
use ProyectoTAU\TAU\Module\Administration\User\Application\update\UpdateUser;
use ProyectoTAU\TAU\Module\Administration\User\Application\delete\DeleteUser;

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

    public function addGroupToUser(Group $group, User $user){}
    public function getGroupsFromUser(User $user):array {return null;}
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

        $userRepository->shouldReceive('create')
            ->once()
            ->with(\Hamcrest\Core\IsEqual::equalTo(
                new User(0, "Test", "Dummy", "fakelogin")));

        $user = new CreateUser($userRepository);
        $user->create(0, "Test", "Dummy", "fakelogin");
	}

    public function testItCanReadAdminUser()
    {
        InMemoryRepository::getInstance()->clear();

        $userRepository = Mockery::mock(DummyUserRepository::class);

        $userRepository->shouldReceive('read')->once()->with(0);

        $user = new ReadUser($userRepository);
        $user->read(0);
    }

    public function testItCanUpdateAdminUser()
    {
        InMemoryRepository::getInstance()->clear();

        $userRepository = Mockery::mock(DummyUserRepository::class);

        $userRepository->shouldReceive('update')->once()->with(0, "Test", "Dummy", "fakelogin");

        $user = new UpdateUser($userRepository);
        $user->update(0, "Test", "Dummy", "fakelogin");
    }

    public function testItCanDeleteAdminUser()
    {
        InMemoryRepository::getInstance()->clear();

        $userRepository = Mockery::mock(DummyUserRepository::class);

        $userRepository->shouldReceive('delete')->once()->with(0);

        $user = new DeleteUser($userRepository);
        $user->delete(0);
    }
}
