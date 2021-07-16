<?php

namespace ProyectoTAU\TAU\Module\Administration\Group\Application\getUsersFromGroup;

use ProyectoTAU\TAU\Module\Administration\Group\Domain\GroupRepository;
use ProyectoTAU\TAU\Module\Administration\Group\Application\read\ReadGroup;

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
        $groupService = new ReadGroup($this->groupRepository);
        $group = $groupService->read($groupId);

        $groupCommand = new GetUsersFromGroupCommand($group);
        return $this->handler->handle($groupCommand);
    }
}
