<?php

namespace ProyectoTAU\TAU\Module\Administration\User\Application\read;

use ProyectoTAU\TAU\Module\Administration\User\Domain\UserRepository;

final class ReadUser {

    private $handler;

    public function __construct(UserRepository $user){
        $this->handler = new ReadUserCommandHandler($user);
    }

	public function read($id){
		$userCommand = new ReadUserCommand($id);
		$this->handler->handle($userCommand);
	}
}
