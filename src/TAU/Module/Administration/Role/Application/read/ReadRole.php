<?php

namespace ProyectoTAU\TAU\Module\Administration\Role\Application\read;

use ProyectoTAU\TAU\Module\Administration\Role\Domain\Role;
use ProyectoTAU\TAU\Module\Administration\Role\Domain\RoleRepository;

final class ReadRole
{
    private $handler;

    public function __construct(RoleRepository $role){
        $this->handler = new ReadRoleCommandHandler($role);
    }

	public function read($id): Role
    {
		$roleCommand = new ReadRoleCommand($id);
		return $this->handler->handle($roleCommand);
	}
}
