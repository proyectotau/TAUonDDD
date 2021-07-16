<?php

namespace ProyectoTAU\TAU\Module\Administration\Group\Application\addUserToGroup;

use ProyectoTAU\TAU\Module\Administration\User\Domain\User;
use ProyectoTAU\TAU\Module\Administration\Group\Domain\Group;
use ProyectoTAU\TAU\Module\Administration\User\Domain\UserRepository;
use ProyectoTAU\TAU\Module\Administration\Group\Domain\GroupRepository;
use ProyectoTAU\TAU\Module\Administration\User\Application\read\ReadUser;
use ProyectoTAU\TAU\Module\Administration\Group\Application\read\ReadGroup;

final class AddUserToGroup
{
    private $handler;
    private $userRepository;
    private $groupRepository;

    public function __construct(UserRepository $user, GroupRepository $group)
    {
        $this->userRepository = $user;
        $this->groupRepository = $group;
        $this->handler = new AddUserToGroupCommandHandler($user, $group);
    }

    public function addUserToGroup($userId, $groupId){
        $userService = new ReadUser($this->userRepository);
        $user = $userService->read($userId);

        $groupService = new ReadGroup($this->groupRepository);
        $group = $groupService->read($groupId);

        $groupCommand = new AddUserToGroupCommand($user, $group);
        $this->handler->handle($groupCommand);
    }
}
