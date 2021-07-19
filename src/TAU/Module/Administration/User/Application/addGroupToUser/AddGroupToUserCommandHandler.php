<?php

namespace ProyectoTAU\TAU\Module\Administration\User\Application\addGroupToUser;

use ProyectoTAU\TAU\Module\Administration\Group\Domain\GroupRepository;
use ProyectoTAU\TAU\Module\Administration\User\Domain\UserRepository;

final class AddGroupToUserCommandHandler
{
    private $groupRepository;
    private $userRepository;

    public function __construct(GroupRepository $group, UserRepository $user)
    {
        $this->groupRepository = $group;
        $this->userRepository = $user;
    }

    public function handle(AddGroupToUserCommand $command)
    {
        $this->userRepository->addGroupToUser($command->group, $command->user);

        $group = $command->group;
        $user = $command->user;
        $user->addGroup($group);
    }
}
