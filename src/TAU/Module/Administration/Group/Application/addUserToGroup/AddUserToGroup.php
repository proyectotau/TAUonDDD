<?php

namespace ProyectoTAU\TAU\Module\Administration\Group\Application\addUserToGroup;

use ProyectoTAU\TAU\Module\Administration\User\Domain\UserRepository;
use ProyectoTAU\TAU\Module\Administration\Group\Domain\GroupRepository;

final class AddUserToGroup
{
    private $userRepository;
    private $groupRepository;
    private $handler;

    public function __construct(UserRepository $user, GroupRepository $group)
    {
        $this->userRepository = $user;
        $this->groupRepository = $group;
        $this->handler = new AddUserToGroupCommandHandler($user, $group);
    }

    public function addUserToGroup($userId, $groupId){
        $groupCommand = new AddUserToGroupCommand($userId, $groupId);
        $this->handler->handle($groupCommand);
    }
}
