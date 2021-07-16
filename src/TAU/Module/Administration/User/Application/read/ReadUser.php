<?php

namespace ProyectoTAU\TAU\Module\Administration\User\Application\read;

use ProyectoTAU\TAU\Module\Administration\User\Domain\User;
use ProyectoTAU\TAU\Module\Administration\User\Domain\UserRepository;

final class ReadUser {

    private $handler;

    public function __construct(UserRepository $user)
    {
        $this->handler = new ReadUserCommandHandler($user);
    }

	public function read($id): User
    {
		$userCommand = new ReadUserCommand($id);
		return $this->handler->handle($userCommand);
	}
}
