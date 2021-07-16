<?php

namespace ProyectoTAU\TAU\Module\Administration\Group\Application\read;

use ProyectoTAU\TAU\Module\Administration\Group\Domain\Group;
use ProyectoTAU\TAU\Module\Administration\Group\Domain\GroupRepository;

final class ReadGroupCommandHandler
{
    private $groupRepository;

    public function __construct(GroupRepository $groupRepository)
    {
        $this->groupRepository = $groupRepository;
    }

    public function handle(ReadGroupCommand $command): Group
    {
        return $this->groupRepository->read($command->id);
    }
}
