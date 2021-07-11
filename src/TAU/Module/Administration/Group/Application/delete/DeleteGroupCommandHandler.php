<?php

namespace ProyectoTAU\TAU\Module\Administration\Group\Application\delete;

use ProyectoTAU\TAU\Module\Administration\Group\Domain\GroupRepository;

final class DeleteGroupCommandHandler
{
    private $groupRepository;

    public function __construct(GroupRepository $groupRepository)
    {
        $this->groupRepository = $groupRepository;
    }

    public function handle(DeleteGroupCommand $command)
    {
        $this->groupRepository->delete($command->id);
    }
}
