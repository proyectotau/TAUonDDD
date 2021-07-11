<?php

namespace ProyectoTAU\TAU\Module\Administration\Group\Application\read;

use ProyectoTAU\TAU\Module\Administration\Group\Domain\GroupRepository;

final class ReadGroupCommandHandler
{
    private $groupRepository;

    public function __construct(GroupRepository $groupRepository)
    {
        $this->groupRepository = $groupRepository;
    }

    public function handle(ReadGroupCommand $command)
    {
        $this->groupRepository->read($command->id);
    }
}
