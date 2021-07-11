<?php

namespace ProyectoTAU\TAU\Module\Administration\Role\Application\update;

use ProyectoTAU\TAU\Module\Administration\Role\Domain\RoleRepository;

final class UpdateRole
{
    private $handler;

    public function __construct(RoleRepository $role){
        $this->handler = new UpdateRoleCommandHandler($role);
    }

	public function update($id, $name, $desc){
		$roleCommand = new UpdateRoleCommand($id, $name, $desc);
		$this->handler->handle($roleCommand);
	}
}
