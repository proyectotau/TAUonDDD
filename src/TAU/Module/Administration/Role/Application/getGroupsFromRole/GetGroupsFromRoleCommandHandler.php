<?php

namespace ProyectoTAU\TAU\Module\Administration\Role\Application\getGroupsFromRole;

use ProyectoTAU\TAU\Module\Administration\Role\Domain\RoleRepository;

final class GetGroupsFromRoleCommandHandler
{
    private $roleRepository;

    public function __construct(RoleRepository $role)
    {
        $this->roleRepository = $role;
    }

    public function handle(GetGroupsFromRoleCommand $command)
    {
        $r = $this->roleRepository->getGroupsFromRole($command->role);

        $role = $command->role;
        $role->getGroups();

        return $r;
    }
}
