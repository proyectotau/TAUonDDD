<?php

namespace ProyectoTAU\TAU\Module\Administration\Role\Application\addModuleToRole;

use ProyectoTAU\TAU\Module\Administration\Module\Domain\ModuleRepository;
use ProyectoTAU\TAU\Module\Administration\Role\Domain\RoleRepository;

final class AddModuleToRoleCommandHandler
{
    private $moduleRepository;
    private $roleRepository;

    public function __construct(ModuleRepository $module, RoleRepository $role)
    {
        $this->moduleRepository = $module;
        $this->roleRepository = $role;
    }

    public function handle(AddModuleToRoleCommand $command)
    {
        $this->roleRepository->addModuleToRole($command->module, $command->role);

        $module = $command->module;
        $role = $command->role;
        $role->addModule($module);
    }
}
