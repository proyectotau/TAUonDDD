<?php

namespace ProyectoTAU\TAU\Module\Administration\User\Application\create;

use ProyectoTAU\TAU\Module\Administration\User\Domain\UserRepository;

final class CreateUser {

    private $handler;

    public function __construct(UserRepository $user){
        $this->handler = new CreateUserCommandHandler($user);
    }

	public function create($id, $name, $surname, $login){
		$userCommand = new CreateUserCommand($id, $name, $surname, $login);
		$this->handler->handle($userCommand);
	}
}
