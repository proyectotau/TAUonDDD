<?php

use PHPUnit\Framework\TestCase;
use ProyectoTAU\TAU\Module\Administration\User\Domain\Repository;
use ProyectoTAU\TAU\Module\Administration\User\Application\create\UserCreator;

final class UserCreatorTest extends TestCase {
	public function testItCanCreateAdminUser()
    {
        $userRepository = new DummyUserRepository();

        $user = new UserCreator($userRepository);
        echo "en test";
        var_dump($user);
        $user->create(0, "Name", "Surname", "login");
        $this->assertTrue(true);
	}
}

class DummyUserRepository implements Repository {

    public function save(): void
    {
        // TODO: Implement save() method.
        echo "SAVE";
    }

    public function delete(): void
    {
        // TODO: Implement delete() method.
    }
}