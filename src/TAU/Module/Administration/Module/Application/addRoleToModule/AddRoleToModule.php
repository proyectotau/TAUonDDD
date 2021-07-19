<?php

namespace ProyectoTAU\TAU\Module\Administration\Module\Application\addRoleToModule;

use ProyectoTAU\TAU\Module\Administration\Role\Domain\RoleRepository;
use ProyectoTAU\TAU\Module\Administration\Module\Domain\ModuleRepository;
use ProyectoTAU\TAU\Module\Administration\Role\Application\read\ReadRole;
use ProyectoTAU\TAU\Module\Administration\Module\Application\read\ReadModule;

final class AddRoleToModule
{
    private $handler;
    private $roleRepository;
    private $moduleRepository;

    public function __construct(RoleRepository $role, ModuleRepository $module)
    {
        $this->roleRepository = $role;
        $this->moduleRepository = $module;
        $this->handler = new AddRoleToModuleCommandHandler($role, $module);
    }

    public function addRoleToModule($roleId, $moduleId){
        $roleService = new ReadRole($this->roleRepository);
        $role = $roleService->read($roleId);

        $moduleService = new ReadModule($this->moduleRepository);
        $module = $moduleService->read($moduleId);

        $moduleCommand = new AddRoleToModuleCommand($role, $module);
        $this->handler->handle($moduleCommand);
    }
}
