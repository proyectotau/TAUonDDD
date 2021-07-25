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
        $role = $this->roleRepository->read($command->roleId);
        $r = $this->roleRepository->getGroupsFromRole($role);

        $role->getGroups();

        return $r;
    }
}
