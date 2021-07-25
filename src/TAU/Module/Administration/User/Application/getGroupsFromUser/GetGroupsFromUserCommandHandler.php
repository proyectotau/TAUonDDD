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
        $user = $this->userRepository->read($command->userId);
        $r = $this->userRepository->getGroupsFromUser($user);

        $user->getGroups();

        return $r;
    }
}
