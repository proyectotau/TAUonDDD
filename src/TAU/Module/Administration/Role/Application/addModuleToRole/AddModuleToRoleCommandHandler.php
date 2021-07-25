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
        $module = $this->moduleRepository->read($command->moduleId);
        $role = $this->roleRepository->read($command->roleId);

        $this->roleRepository->addModuleToRole($module, $role);

        $role->addModule($module);
    }
}
