<?php

namespace ProyectoTAU\TAU\Module\Administration\Group\Application\delete;

use ProyectoTAU\TAU\Module\Administration\Group\Domain\GroupRepository;

final class DeleteGroup
{
    private $handler;

    public function __construct(GroupRepository $group){
        $this->handler = new DeleteGroupCommandHandler($group);
    }

	public function delete($id){
		$groupCommand = new DeleteGroupCommand($id);
		$this->handler->handle($groupCommand);
	}
}
