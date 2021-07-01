<?php

namespace TAU\Module\Administration\User\Application\create;

use TAU\Module\Administration\User\Domain\Repository;
use TAU\Module\Administration\User\Domain\User;

final class UserCreator {

    private $userRepository;

    public function UserCreator(Repository $user){
        $this->userRepository = $user;
    }

	public function create($id, $name, $surname, $login){
		$user = new User($id, $name, $surname, $login);
        $this->userRepository->save();
	}
}