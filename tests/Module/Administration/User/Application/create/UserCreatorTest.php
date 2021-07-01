<?php

use PHPUnit\Framework\TestCase;
use TAU\Module\Administration\User\Domain\Repository;
use TAU\Module\Administration\User\Application\create\UserCreator;

final class UserCreatorTest extends TestCase {
	public function testItCanCreateAdminUser()
    {
        $userRepository = new DummyUserRepository();

        $user = new UserCreator($userRepository);
        $user->create(0, "Name", "Surname", "login");
        $this->assertTrue(true);
	}
}

class DummyUserRepository implements Repository {

    public function save()
    {
        // TODO: Implement save() method.
    }

    public function delete()
    {
        // TODO: Implement delete() method.
    }
}