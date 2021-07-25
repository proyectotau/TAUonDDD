<?php

namespace ProyectoTAU\TAU\Module\Administration\User\Application\addGroupToUser;

use ProyectoTAU\TAU\Module\Administration\Group\Domain\GroupRepository;
use ProyectoTAU\TAU\Module\Administration\User\Domain\UserRepository;

final class AddGroupToUser
{
    private $groupRepository;
    private $userRepository;
    private $handler;

    public function __construct(GroupRepository $group, UserRepository $user)
    {
        $this->groupRepository = $group;
        $this->userRepository = $user;
        $this->handler = new AddGroupToUserCommandHandler($group, $user);
    }

    public function addGroupToUser($groupId, $userId){
        $userCommand = new AddGroupToUserCommand($groupId, $userId);
        $this->handler->handle($userCommand);
    }
}
