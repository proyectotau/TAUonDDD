<?php

namespace ProyectoTAU\TAU\Module\Administration\Group\Application\read;

use ProyectoTAU\TAU\Module\Administration\Group\Domain\Group;
use ProyectoTAU\TAU\Module\Administration\Group\Domain\GroupRepository;

final class ReadGroup
{
    private $handler;

    public function __construct(GroupRepository $group)
    {
        $this->handler = new ReadGroupCommandHandler($group);
    }

	public function read($id): Group
    {
		$groupCommand = new ReadGroupCommand($id);
		return $this->handler->handle($groupCommand);
	}
}
