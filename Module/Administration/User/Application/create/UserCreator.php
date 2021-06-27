<?php

namespace TAU\Module\Administration\User\Application\create;

use TAU\Module\Administration\User\Domain\User;

final class UserCreator {
	
	public function __invoke($id, $name, $surname, $login){
		$user = new User($id, $name, $surname, $login);
		$user->save();
	}
}