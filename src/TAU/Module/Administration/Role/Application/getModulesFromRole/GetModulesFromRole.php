<?php

namespace ProyectoTAU\TAU\Module\Administration\Role\Application\getModulesFromRole;

use ProyectoTAU\TAU\Module\Administration\Role\Domain\RoleRepository;

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
        $roleCommand = new GetModulesFromRoleCommand($roleId);
        return $this->handler->handle($roleCommand);
    }
}
