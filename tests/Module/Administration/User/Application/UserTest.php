<?php

use Mockery\Adapter\Phpunit\MockeryTestCase as TestCase;
use ProyectoTAU\TAU\Module\Administration\User\Domain\User;
use ProyectoTAU\TAU\Module\Administration\User\Domain\Repository;
use ProyectoTAU\TAU\Module\Administration\User\Application\create\UserCreator;
use ProyectoTAU\TAU\Module\Administration\User\Application\destroy\UserDestroyer;

class DummyUserRepository implements Repository {

    public function save($id, $name, $surname, $login): void
    {
        // Should receive a call once with the same Dummy User as argument
        if( ! ($id === 0 &&
               $ame === 'Test' &&
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
        $userRepository->shouldNotReceive('delete');

        $user = new UserCreator($userRepository);
        $user->create(0, "Test", "Dummy", "fakelogin");
	}

    public function testItCanDeleteAdminUser()
    {
        $userRepository = Mockery::mock(DummyUserRepository::class);

        $userRepository->shouldReceive('delete')->once()->with(0);
        $userRepository->shouldNotReceive('save');

        $user = new UserDestroyer($userRepository);
        $user->destroy(0);
    }
}