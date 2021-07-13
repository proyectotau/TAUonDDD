<?php

namespace ProyectoTAU\TAU\Module\Administration\Group\Application\create;

use ProyectoTAU\TAU\Module\Administration\Group\Domain\Group;
use ProyectoTAU\TAU\Module\Administration\Group\Domain\GroupRepository;

final class CreateGroupCommandHandler
{
    private $groupRepository;

    public function __construct(GroupRepository $groupRepository)
    {
        $this->groupRepository = $groupRepository;
    }

    public function handle(CreateGroupCommand $command)
    {
        $this->groupRepository->create(new Group($command->id, $command->name, $command->desc));
    }
}
