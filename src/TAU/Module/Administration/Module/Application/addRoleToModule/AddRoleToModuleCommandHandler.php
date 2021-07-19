<?php

namespace ProyectoTAU\TAU\Module\Administration\Module\Application\addRoleToModule;

use ProyectoTAU\TAU\Module\Administration\Role\Domain\RoleRepository;
use ProyectoTAU\TAU\Module\Administration\Module\Domain\ModuleRepository;

final class AddRoleToModuleCommandHandler
{
    private $roleRepository;
    private $moduleRepository;

    public function __construct(RoleRepository $role, ModuleRepository $module)
    {
        $this->roleRepository = $role;
        $this->moduleRepository = $module;
    }

    public function handle(AddRoleToModuleCommand $command)
    {
        $this->moduleRepository->addRoleToModule($command->role, $command->module);

        $role = $command->role;
        $module = $command->module;
        $module->addRole($role);
    }
}
