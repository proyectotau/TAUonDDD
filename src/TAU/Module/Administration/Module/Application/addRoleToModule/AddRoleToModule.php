<?php

namespace ProyectoTAU\TAU\Module\Administration\Module\Application\addRoleToModule;

use ProyectoTAU\TAU\Module\Administration\Role\Domain\RoleRepository;
use ProyectoTAU\TAU\Module\Administration\Module\Domain\ModuleRepository;

final class AddRoleToModule
{
    private $roleRepository;
    private $moduleRepository;
    private $handler;

    public function __construct(RoleRepository $role, ModuleRepository $module)
    {
        $this->roleRepository = $role;
        $this->moduleRepository = $module;
        $this->handler = new AddRoleToModuleCommandHandler($role, $module);
    }

    public function addRoleToModule($roleId, $moduleId){
        $moduleCommand = new AddRoleToModuleCommand($roleId, $moduleId);
        $this->handler->handle($moduleCommand);
    }
}
