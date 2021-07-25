<?php

namespace ProyectoTAU\TAU\Module\Administration\Role\Application\getModulesFromRole;

use ProyectoTAU\TAU\Module\Administration\Role\Domain\RoleRepository;

final class GetModulesFromRoleCommandHandler
{
    private $roleRepository;

    public function __construct(RoleRepository $role)
    {
        $this->roleRepository = $role;
    }

    public function handle(GetModulesFromRoleCommand $command)
    {
        $role = $this->roleRepository->read($command->roleId);
        $r = $this->roleRepository->getModulesFromRole($role);

        $role->getModules();

        return $r;
    }
}
