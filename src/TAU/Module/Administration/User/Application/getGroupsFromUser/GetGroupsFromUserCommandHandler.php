<?php

namespace ProyectoTAU\TAU\Module\Administration\User\Application\getGroupsFromUser;

use ProyectoTAU\TAU\Module\Administration\User\Domain\UserRepository;

final class GetGroupsFromUserCommandHandler
{
    private $userRepository;

    public function __construct(UserRepository $user)
    {
        $this->userRepository = $user;
    }

    public function handle(GetGroupsFromUserCommand $command)
    {
        $r = $this->userRepository->getGroupsFromUser($command->user);

        $user = $command->user;
        $user->getGroups();

        return $r;
    }
}
