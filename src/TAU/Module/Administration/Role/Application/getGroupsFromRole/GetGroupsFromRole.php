<?php

namespace ProyectoTAU\TAU\Module\Administration\Role\Application\getGroupsFromRole;

use ProyectoTAU\TAU\Module\Administration\Role\Domain\RoleRepository;

final class GetGroupsFromRole
{
    private $handler;
    private $roleRepository;

    public function __construct(RoleRepository $role)
    {
        $this->roleRepository = $role;
        $this->handler = new GetGroupsFromRoleCommandHandler($role);
    }

    public function getGroupsFromRole($roleId){
        $roleCommand = new GetGroupsFromRoleCommand($roleId);
        return $this->handler->handle($roleCommand);
    }
}
