<?php

namespace ProyectoTAU\TAU\Module\Administration\User\Application\create;

use ProyectoTAU\TAU\Module\Administration\User\Domain\Repository;
use ProyectoTAU\TAU\Module\Administration\User\Domain\User;

final class UserCreator {

    private $userRepository;

    public function __construct(Repository $user){
        echo "en construct";
        var_dump($user);
        $this->userRepository = $user;
    }

	public function create($id, $name, $surname, $login){
		$user = new User($id, $name, $surname, $login);
        $this->userRepository->save();
	}
}