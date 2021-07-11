<?php

namespace ProyectoTAU\TAU\Module\Administration\Group\Application\update;

use ProyectoTAU\TAU\Module\Administration\Group\Domain\GroupRepository;

final class UpdateGroup
{
    private $handler;

    public function __construct(GroupRepository $group){
        $this->handler = new UpdateGroupCommandHandler($group);
    }

	public function update($id, $name, $desc){
		$groupCommand = new UpdateGroupCommand($id, $name, $desc);
		$this->handler->handle($groupCommand);
	}
}
