<?php

namespace ProyectoTAU\TAU\Module\Administration\Group\Application\getRolesFromGroup;

use ProyectoTAU\TAU\Module\Administration\Group\Domain\GroupRepository;
use ProyectoTAU\TAU\Module\Administration\Group\Application\read\ReadGroup;

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
        $groupService = new ReadGroup($this->groupRepository);
        $group = $groupService->read($groupId);

        $groupCommand = new GetRolesFromGroupCommand($group);
        return $this->handler->handle($groupCommand);
    }
}
