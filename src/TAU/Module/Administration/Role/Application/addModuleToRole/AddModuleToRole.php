<?php

namespace ProyectoTAU\TAU\Module\Administration\Role\Application\addModuleToRole;

use ProyectoTAU\TAU\Module\Administration\Module\Domain\ModuleRepository;
use ProyectoTAU\TAU\Module\Administration\Role\Domain\RoleRepository;

final class AddModuleToRole
{
    private $moduleRepository;
    private $roleRepository;
    private $handler;

    public function __construct(ModuleRepository $module, RoleRepository $role)
    {
        $this->moduleRepository = $module;
        $this->roleRepository = $role;
        $this->handler = new AddModuleToRoleCommandHandler($module, $role);
    }

    public function addModuleToRole($moduleId, $roleId){
        $roleCommand = new AddModuleToRoleCommand($moduleId, $roleId);
        $this->handler->handle($roleCommand);
    }
}
