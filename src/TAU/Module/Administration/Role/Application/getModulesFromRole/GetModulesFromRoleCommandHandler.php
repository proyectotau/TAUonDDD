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
        $r = $this->roleRepository->getModulesFromRole($command->role);

        $role = $command->role;
        $role->getModules();

        return $r;
    }
}
