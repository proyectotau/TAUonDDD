<?php

namespace ProyectoTAU\TAU\Module\Administration\User\Application\create;

use ProyectoTAU\TAU\Module\Administration\User\Domain\Repository;
use ProyectoTAU\TAU\Module\Administration\User\Domain\User;

final class UserCreator {

    private $userRepository;
    private $userCreated;

    public function __construct(Repository $user){
        $this->userRepository = $user;
    }

	public function create($id, $name, $surname, $login){
		$user = new User($id, $name, $surname, $login);
		$this->userCreated = $user;
        $this->userRepository->save($user);
	}

	public function getUserCreated(): User {
	    return $this->userCreated;
    }
}