<?php

namespace ProyectoTAU\TAU\Module\Administration\Group\Application\getRolesFromGroup;

use ProyectoTAU\TAU\Module\Administration\Group\Domain\GroupRepository;

final class GetRolesFromGroup
{
    private $handler;
    private $groupRepository;

    public function __construct(GroupRepository $group)
    {
        $this->groupRepository = $group;
        $this->handler = new GetRolesFromGroupCommandHandler($group);
    }

    public function getRolesFromGroup($groupId){
        $groupCommand = new GetRolesFromGroupCommand($groupId);
        return $this->handler->handle($groupCommand);
    }
}
