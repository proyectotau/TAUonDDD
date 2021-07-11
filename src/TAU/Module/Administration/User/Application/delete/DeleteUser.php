<?php

namespace ProyectoTAU\TAU\Module\Administration\User\Application\delete;

use ProyectoTAU\TAU\Module\Administration\User\Domain\UserRepository;

final class DeleteUser
{
    private $handler;

    public function __construct(UserRepository $user){
        $this->handler = new DeleteUserCommandHandler($user);
    }

	public function delete($id){
		$userCommand = new DeleteUserCommand($id);
		$this->handler->handle($userCommand);
	}
}
