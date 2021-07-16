<?php

namespace ProyectoTAU\TAU\Module\Administration\Group\Application\addUserToGroup;

use ProyectoTAU\TAU\Module\Administration\Group\Domain\GroupRepository;
use ProyectoTAU\TAU\Module\Administration\User\Domain\UserRepository;

final class AddUserToGroupCommandHandler
{
    private $userRepository;
    private $groupRepository;

    public function __construct(UserRepository $user, GroupRepository $group)
    {
        $this->userRepository = $user;
        $this->groupRepository = $group;
    }

    public function handle(AddUserToGroupCommand $command)
    {
        $this->groupRepository->addUserToGroup($command->user, $command->group);

        $user = $command->user;
        $group = $command->group;
        $group->addUser($user);
    }
}
