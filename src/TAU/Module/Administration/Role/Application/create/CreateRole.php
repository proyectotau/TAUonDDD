<?php

namespace ProyectoTAU\TAU\Module\Administration\Role\Application\create;

use ProyectoTAU\TAU\Module\Administration\Role\Domain\RoleRepository;

final class CreateRole
{
    private $handler;

    public function __construct(RoleRepository $role){
        $this->handler = new CreateRoleCommandHandler($role);
    }

	public function create($id, $name, $desc){
		$roleCommand = new CreateRoleCommand($id, $name, $desc);
		$this->handler->handle($roleCommand);
	}
}
