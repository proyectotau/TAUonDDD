<?php

namespace ProyectoTAU\TAU\Module\Administration\Group\Application\getUsersFromGroup;

use ProyectoTAU\TAU\Module\Administration\Group\Domain\GroupRepository;

final class GetUsersFromGroupCommandHandler
{
    private $groupRepository;

    public function __construct(GroupRepository $group)
    {
        $this->groupRepository = $group;
    }

    public function handle(GetUsersFromGroupCommand $command)
    {
        $group = $this->groupRepository->read($command->groupId);
        $r = $this->groupRepository->getUsersFromGroup($group);

        $group->getUsers();

        return $r;
    }
}
