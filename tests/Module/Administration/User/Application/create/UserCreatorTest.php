<?php

use Mockery\Adapter\Phpunit\MockeryTestCase as TestCase;
use ProyectoTAU\TAU\Module\Administration\User\Domain\User;
use ProyectoTAU\TAU\Module\Administration\User\Domain\Repository;
use ProyectoTAU\TAU\Module\Administration\User\Application\create\UserCreator;
use ProyectoTAU\TAU\Module\Administration\User\Application\destroy\UserDestroyer;

class DummyUserRepository implements Repository {

    public function save(User $user): void
    {
        // Should receive a call once with the same Dummy User as argument
        if( ! ($user->getId() === 0 &&
               $user->getName() == 'Test' &&
               $user->getSurname() == 'Dummy' &&
               $user->getLogin() == 'fakelogin') )
            throw new \InvalidArgumentException("Mismatched User received by save method");
    }

    public function delete($id): void
    {
        // Should receive a call with id === 0
    }
}

final class UserCreatorTest extends TestCase {
    public function mockeryTestTearDown()
    {
        Mockery::close();
    }

	public function testItCanCreateAdminUser()
    {
        $userRepository = Mockery::mock(DummyUserRepository::class);

        $user = new UserCreator($userRepository);

        $userRepository->shouldReceive('save')->once()->with($user->getUserCreated());
        $userRepository->shouldNotReceive('delete');

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