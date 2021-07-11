<?php

namespace ProyectoTAU\TAU\Module\Administration\Role\Application\read;

use ProyectoTAU\TAU\Module\Administration\Role\Domain\RoleRepository;

final class ReadRole
{
    private $handler;

    public function __construct(RoleRepository $role){
        $this->handler = new ReadRoleCommandHandler($role);
    }

	public function read($id){
		$roleCommand = new ReadRoleCommand($id);
		$this->handler->handle($roleCommand);
	}
}
