<?php

namespace ProyectoTAU\TAU\Module\Administration\User\Application\removeGroupFromUser;

use ProyectoTAU\TAU\Module\Administration\Group\Domain\GroupRepository;
use ProyectoTAU\TAU\Module\Administration\User\Domain\UserRepository;

final class RemoveGroupFromUserCommandHandler
{
    private $groupRepository;
    private $userRepository;

    public function __construct(GroupRepository $group, UserRepository $user)
    {
        $this->groupRepository = $group;
        $this->userRepository = $user;
    }

    public function handle(RemoveGroupFromUserCommand $command)
    {
        $group = $this->groupRepository->read($command->groupId);
        $user = $this->userRepository->read($command->userId);

        $this->userRepository->removeGroupFromUser($group, $user);

        $user->removeGroup($group);
    }
}
