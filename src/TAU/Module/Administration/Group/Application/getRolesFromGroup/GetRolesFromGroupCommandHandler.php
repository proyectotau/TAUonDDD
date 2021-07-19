<?php

namespace ProyectoTAU\TAU\Module\Administration\Group\Application\getRolesFromGroup;

use ProyectoTAU\TAU\Module\Administration\Group\Domain\GroupRepository;

final class GetRolesFromGroupCommandHandler
{
    private $groupRepository;

    public function __construct(GroupRepository $group)
    {
        $this->groupRepository = $group;
    }

    public function handle(GetRolesFromGroupCommand $command)
    {
        $r = $this->groupRepository->getRolesFromGroup($command->group);

        $group = $command->group;
        $group->getRoles();

        return $r;
    }
}
