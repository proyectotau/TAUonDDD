<?php

namespace ProyectoTAU\TAU\Module\Administration\Group\Application\create;

use ProyectoTAU\TAU\Module\Administration\Group\Domain\GroupRepository;

final class CreateGroup
{
    private $handler;

    public function __construct(GroupRepository $group){
        $this->handler = new CreateGroupCommandHandler($group);
    }

	public function create($id, $name, $desc){
		$groupCommand = new CreateGroupCommand($id, $name, $desc);
		$this->handler->handle($groupCommand);
	}
}
