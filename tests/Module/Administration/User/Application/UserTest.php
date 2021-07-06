<?php

use Mockery\Adapter\Phpunit\MockeryTestCase as TestCase;
use ProyectoTAU\TAU\Module\Administration\User\Domain\User;
use ProyectoTAU\TAU\Module\Administration\User\Domain\Repository;
use ProyectoTAU\TAU\Module\Administration\User\Application\create\UserCreator;
use ProyectoTAU\TAU\Module\Administration\User\Application\destroy\UserDestroyer;
use ProyectoTAU\TAU\Module\Administration\User\Application\update\UserUpdater;
use ProyectoTAU\TAU\Module\Administration\User\Application\read\UserReader;

class DummyUserRepository implements Repository {

    public function save($id, $name, $surname, $login): void
    {
        // Should receive a call once with the same Dummy User as argument
        if( ! ($id === 0 &&
               $name === 'Test' &&
               $surname === 'Dummy' &&
               $login === 'fakelogin') )
            throw new \InvalidArgumentException("Mismatched User received by save method");
    }

    public function delete($id): void
    {
        // Should receive a call with id === 0
        if( ! ($id === 0) ) {
            throw new \InvalidArgumentException("Mismatched User received by delete method");
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

    public function read($id): void
    {
        // Should receive a call with id === 0
        if( ! ($id === 0) ) {
            throw new \InvalidArgumentException("Mismatched User received by read method");
        }
    }
}

final class UserTest extends TestCase {
    public function mockeryTestTearDown()
    {
        Mockery::close();
    }

	public function testItCanCreateAdminUser()
    {
        $userRepository = Mockery::mock(DummyUserRepository::class);

        $userRepository->shouldReceive('save')->once()->with(0, "Test", "Dummy", "fakelogin");

        $user = new UserCreator($userRepository);
        $user->create(0, "Test", "Dummy", "fakelogin");
	}

    public function testItCanDeleteAdminUser()
    {
        $userRepository = Mockery::mock(DummyUserRepository::class);

        $userRepository->shouldReceive('delete')->once()->with(0);

        $user = new UserDestroyer($userRepository);
        $user->destroy(0);
    }

    public function testItCanModifyAdminUser()
    {
        $userRepository = Mockery::mock(DummyUserRepository::class);

        $userRepository->shouldReceive('update')->once()->with(0, "Test", "Dummy", "fakelogin");

        $user = new UserUpdater($userRepository);
        $user->update(0, "Test", "Dummy", "fakelogin");
    }

    public function testItCanReadAdminUser()
    {
        $userRepository = Mockery::mock(DummyUserRepository::class);

        $userRepository->shouldReceive('read')->once()->with(0);

        $user = new UserReader($userRepository);
        $user->read(0);
    }
}