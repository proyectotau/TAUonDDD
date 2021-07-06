<?php
/**
 * Created by PhpStorm.
 * User: Usuario
 * Date: 07/07/2021
 * Time: 0:08
 */

namespace ProyectoTAU\TAU\Module\Administration\User\Application\update;

use ProyectoTAU\TAU\Module\Administration\User\Domain\Repository;

final class UserUpdater
{
    private $handler;

    public function __construct(Repository $user){
        $this->handler = new UserUpdateCommandHandler($user);
    }

    public function update($id, $name, $surname, $login){
        $userCommand = new UserUpdateCommand($id, $name, $surname, $login);
        $this->handler->handle($userCommand);
    }
}
