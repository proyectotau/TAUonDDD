<?php

namespace ProyectoTAU\TAU\Module\Administration\Role\Application\getModulesFromRole;

use ProyectoTAU\TAU\Module\Administration\Role\Domain\RoleRepository;
use ProyectoTAU\TAU\Module\Administration\Role\Application\read\ReadRole;

final class GetModulesFromRole
{
    private $handler;
    private $roleRepository;

    public function __construct(RoleRepository $role)
    {
        $this->roleRepository = $role;
        $this->handler = new GetModulesFromRoleCommandHandler($role);
    }

    public function getModulesFromRole($roleId){
        $roleService = new ReadRole($this->roleRepository);
        $role = $roleService->read($roleId);

        $roleCommand = new GetModulesFromRoleCommand($role);
        return $this->handler->handle($roleCommand);
    }
}
