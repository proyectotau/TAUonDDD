<?php

namespace ProyectoTAU\TAU\Module\Administration\Role\Application\delete;

use ProyectoTAU\TAU\Module\Administration\Role\Domain\RoleRepository;

final class DeleteRole
{
    private $handler;

    public function __construct(RoleRepository $role){
        $this->handler = new DeleteRoleCommandHandler($role);
    }

	public function delete($id){
		$roleCommand = new DeleteRoleCommand($id);
		$this->handler->handle($roleCommand);
	}
}
