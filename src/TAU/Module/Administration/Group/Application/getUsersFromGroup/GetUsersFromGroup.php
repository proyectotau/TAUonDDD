<?php

namespace ProyectoTAU\TAU\Module\Administration\Group\Application\getUsersFromGroup;

use ProyectoTAU\TAU\Module\Administration\Group\Domain\GroupRepository;

final class GetUsersFromGroup
{
    private $handler;
    private $groupRepository;

    public function __construct(GroupRepository $group)
    {
        $this->groupRepository = $group;
        $this->handler = new GetUsersFromGroupCommandHandler($group);
    }

    public function getUsersFromGroup($groupId){
        $groupCommand = new GetUsersFromGroupCommand($groupId);
        return $this->handler->handle($groupCommand);
    }
}
