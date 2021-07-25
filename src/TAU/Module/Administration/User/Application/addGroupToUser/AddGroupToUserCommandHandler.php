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
        $group = $this->groupRepository->read($command->groupId);
        $user = $this->userRepository->read($command->userId);

        $this->userRepository->addGroupToUser($group, $user);

        $user->addgroup($group);
    }
}
