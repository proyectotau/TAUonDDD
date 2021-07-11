<?php

namespace ProyectoTAU\TAU\Module\Administration\User\Application\update;

use ProyectoTAU\TAU\Module\Administration\User\Domain\UserRepository;

final class UpdateUser
{
    private $handler;

    public function __construct(UserRepository $user){
        $this->handler = new UpdateUserCommandHandler($user);
    }

	public function update($id, $name, $surname, $login){
		$userCommand = new UpdateUserCommand($id, $name, $surname, $login);
		$this->handler->handle($userCommand);
	}
}
