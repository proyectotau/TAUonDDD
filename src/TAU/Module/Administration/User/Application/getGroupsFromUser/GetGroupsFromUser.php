<?php

namespace ProyectoTAU\TAU\Module\Administration\User\Application\getGroupsFromUser;

use ProyectoTAU\TAU\Module\Administration\User\Domain\UserRepository;
use ProyectoTAU\TAU\Module\Administration\User\Application\read\ReadUser;

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
        $userService = new ReadUser($this->userRepository);
        $user = $userService->read($userId);

        $userCommand = new GetGroupsFromUserCommand($user);
        return $this->handler->handle($userCommand);
    }
}
