<?php

namespace ProyectoTAU\TAU\Module\Administration\Group\Application\getUsersFromGroup;

use ProyectoTAU\TAU\Module\Administration\Group\Domain\GroupRepository;

final class GetUsersFromGroupCommandHandler
{
    private $userRepository;
    private $groupRepository;

    public function __construct(GroupRepository $group)
    {
        $this->groupRepository = $group;
    }

    public function handle(GetUsersFromGroupCommand $command)
    {
        return $this->groupRepository->getUsersFromGroup($command->group);
        /*
        $group = $command->group;
        $group->getUsers();
        */
    }
}
