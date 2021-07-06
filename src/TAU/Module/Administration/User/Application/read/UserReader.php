<?php

namespace ProyectoTAU\TAU\Module\Administration\User\Application\read;

use ProyectoTAU\TAU\Module\Administration\User\Domain\Repository;

final class UserReader
{
    private $handler;

    public function __construct(Repository $user){
        $this->handler = new UserReaderCommandHandler($user);
    }

    public function read($id){
        $userCommand = new UserReaderCommand($id);
        $this->handler->handle($userCommand);
    }
}