<?php

namespace ProyectoTAU\TAU\Module\Administration\Role\Application\getGroupsFromRole;

use ProyectoTAU\TAU\Module\Administration\Role\Domain\RoleRepository;
use ProyectoTAU\TAU\Module\Administration\Role\Application\read\ReadRole;

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
        $roleService = new ReadRole($this->roleRepository);
        $role = $roleService->read($roleId);

        $roleCommand = new GetGroupsFromRoleCommand($role);
        return $this->handler->handle($roleCommand);
    }
}
