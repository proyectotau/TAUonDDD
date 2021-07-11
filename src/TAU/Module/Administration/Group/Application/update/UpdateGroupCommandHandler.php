<?php

namespace ProyectoTAU\TAU\Module\Administration\Group\Application\update;

use ProyectoTAU\TAU\Module\Administration\Group\Domain\GroupRepository;

final class UpdateGroupCommandHandler
{
    private $groupRepository;

    public function __construct(GroupRepository $groupRepository)
    {
        $this->groupRepository = $groupRepository;
    }

    public function handle(UpdateGroupCommand $command)
    {
        $this->groupRepository->update($command->id, $command->name, $command->desc);
    }
}
