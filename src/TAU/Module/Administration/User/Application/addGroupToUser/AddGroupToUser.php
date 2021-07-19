<?php

namespace ProyectoTAU\TAU\Module\Administration\User\Application\addGroupToUser;

use ProyectoTAU\TAU\Module\Administration\Group\Domain\GroupRepository;
use ProyectoTAU\TAU\Module\Administration\User\Domain\UserRepository;
use ProyectoTAU\TAU\Module\Administration\Group\Application\read\ReadGroup;
use ProyectoTAU\TAU\Module\Administration\User\Application\read\ReadUser;

final class AddGroupToUser
{
    private $handler;
    private $groupRepository;
    private $userRepository;

    public function __construct(GroupRepository $group, UserRepository $user)
    {
        $this->groupRepository = $group;
        $this->userRepository = $user;
        $this->handler = new AddGroupToUserCommandHandler($group, $user);
    }

    public function addGroupToUser($groupId, $userId){
        $groupService = new ReadGroup($this->groupRepository);
        $group = $groupService->read($groupId);

        $userService = new ReadUser($this->userRepository);
        $user = $userService->read($userId);

        $userCommand = new AddGroupToUserCommand($group, $user);
        $this->handler->handle($userCommand);
    }
}
