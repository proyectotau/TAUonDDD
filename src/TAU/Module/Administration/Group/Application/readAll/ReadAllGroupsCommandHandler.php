<?php

namespace ProyectoTAU\TAU\Module\Administration\Group\Application\readAll;

use ProyectoTAU\TAU\Module\Administration\Group\Domain\GroupRepository;

final class ReadAllGroupsCommandHandler
{
    private $groupRepository;

    public function __construct(GroupRepository $groupRepository)
    {
        $this->groupRepository = $groupRepository;
    }

    public function handle(ReadAllGroupsCommand $command): array
    {
        return $this->groupRepository->readAll();
    }
}
