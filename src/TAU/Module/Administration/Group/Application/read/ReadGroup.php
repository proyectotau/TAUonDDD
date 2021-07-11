<?php

namespace ProyectoTAU\TAU\Module\Administration\Group\Application\read;

use ProyectoTAU\TAU\Module\Administration\Group\Domain\GroupRepository;

final class ReadGroup
{
    private $handler;

    public function __construct(GroupRepository $group){
        $this->handler = new ReadGroupCommandHandler($group);
    }

	public function read($id){
		$groupCommand = new ReadGroupCommand($id);
		$this->handler->handle($groupCommand);
	}
}
