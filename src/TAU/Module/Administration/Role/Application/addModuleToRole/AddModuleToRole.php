<?php

namespace ProyectoTAU\TAU\Module\Administration\Role\Application\addModuleToRole;

use ProyectoTAU\TAU\Module\Administration\Module\Domain\ModuleRepository;
use ProyectoTAU\TAU\Module\Administration\Role\Domain\RoleRepository;
use ProyectoTAU\TAU\Module\Administration\Module\Application\read\ReadModule;
use ProyectoTAU\TAU\Module\Administration\Role\Application\read\ReadRole;

final class AddModuleToRole
{
    private $handler;
    private $moduleRepository;
    private $roleRepository;

    public function __construct(ModuleRepository $module, RoleRepository $role)
    {
        $this->moduleRepository = $module;
        $this->roleRepository = $role;
        $this->handler = new AddModuleToRoleCommandHandler($module, $role);
    }

    public function addModuleToRole($moduleId, $roleId){
        $moduleService = new ReadModule($this->moduleRepository);
        $module = $moduleService->read($moduleId);

        $roleService = new ReadRole($this->roleRepository);
        $role = $roleService->read($roleId);

        $roleCommand = new AddModuleToRoleCommand($module, $role);
        $this->handler->handle($roleCommand);
    }
}
