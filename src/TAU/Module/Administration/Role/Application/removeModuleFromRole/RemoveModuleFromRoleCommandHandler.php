<?php

namespace ProyectoTAU\TAU\Module\Administration\Role\Application\removeModuleFromRole;

use ProyectoTAU\TAU\Module\Administration\Module\Domain\ModuleRepository;
use ProyectoTAU\TAU\Module\Administration\Role\Domain\RoleRepository;

final class RemoveModuleFromRoleCommandHandler
{
    private $moduleRepository;
    private $roleRepository;

    public function __construct(ModuleRepository $module, RoleRepository $role)
    {
        $this->moduleRepository = $module;
        $this->roleRepository = $role;
    }

    public function handle(RemoveModuleFromRoleCommand $command)
    {
        $module = $this->moduleRepository->read($command->moduleId);
        $role = $this->roleRepository->read($command->roleId);

        $this->roleRepository->removeModuleFromRole($module, $role); //TODO: remove must use id only, do not read

        $role->removeModule($module);
    }
}
