<?php

namespace ProyectoTAU\TAU\Module\Administration\User\Application\destroy;

use ProyectoTAU\TAU\Module\Administration\User\Domain\Repository;

final class UserDestroyer {

    private $handler;

    public function __construct(Repository $user){
        $this->handler = new UserDestroyCommandHandler($user);
    }

    public function destroy($id){
        $userCommand = new UserDestroyCommand($id);
        $this->handler->handle($userCommand);
    }
}
