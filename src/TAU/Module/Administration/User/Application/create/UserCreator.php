<?php

namespace ProyectoTAU\TAU\Module\Administration\User\Application\create;

use ProyectoTAU\TAU\Module\Administration\User\Domain\Repository;

final class UserCreator {

    private $handler;

    public function __construct(Repository $user){
        $this->handler = new UserCreateCommandHandler($user);
    }

	public function create($id, $name, $surname, $login){
		$userCommand = new UserCreateCommand($id, $name, $surname, $login);
		$this->handler->handle($userCommand);
	}
}
