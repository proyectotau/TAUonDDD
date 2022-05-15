<?php

namespace ProyectoTAU\TAU\Module\Administration\Module\Application\removeRoleFromModule;


use ProyectoTAU\TAU\Module\Administration\Role\Domain\RoleRepository;
use ProyectoTAU\TAU\Module\Administration\Module\Domain\ModuleRepository;

final class RemoveRoleFromModuleCommandHandler
{
    private $roleRepository;
    private $moduleRepository;

    public function __construct(RoleRepository $role, ModuleRepository $module)
    {
        $this->roleRepository = $role;
        $this->moduleRepository = $module;
    }

    public function handle(RemoveRoleFromModuleCommand $command)
    {
        $role = $this->roleRepository->read($command->roleId);
        $module = $this->moduleRepository->read($command->moduleId);

        $this->moduleRepository->removeRoleFromModule($role, $module);

        $module->removeRole($role);
    }
}
