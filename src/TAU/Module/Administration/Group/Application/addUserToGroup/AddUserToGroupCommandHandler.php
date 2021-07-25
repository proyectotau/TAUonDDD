<?php

namespace ProyectoTAU\TAU\Module\Administration\Group\Application\addUserToGroup;

use ProyectoTAU\TAU\Module\Administration\User\Domain\UserRepository;
use ProyectoTAU\TAU\Module\Administration\Group\Domain\GroupRepository;

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
        $user = $this->userRepository->read($command->userId);
        $group = $this->groupRepository->read($command->groupId);

        $this->groupRepository->addUserToGroup($user, $group);

        $group->adduser($user);
    }
}
