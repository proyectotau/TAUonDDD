<?php

namespace ProyectoTAU\TAU\Module\Administration\User\Application\getGroupsFromUser;

use ProyectoTAU\TAU\Module\Administration\User\Domain\UserRepository;

final class GetGroupsFromUser
{
    private $handler;
    private $userRepository;

    public function __construct(UserRepository $user)
    {
        $this->userRepository = $user;
        $this->handler = new GetGroupsFromUserCommandHandler($user);
    }

    public function getGroupsFromUser($userId){
        $userCommand = new GetGroupsFromUserCommand($userId);
        return $this->handler->handle($userCommand);
    }
}
