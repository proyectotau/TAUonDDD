<?php

namespace ProyectoTAU\TAU\Module\Administration\Module\Application\getRolesFromModule;

use ProyectoTAU\TAU\Module\Administration\Module\Domain\ModuleRepository;

final class GetRolesFromModule
{
    private $handler;
    private $moduleRepository;

    public function __construct(ModuleRepository $module)
    {
        $this->moduleRepository = $module;
        $this->handler = new GetRolesFromModuleCommandHandler($module);
    }

    public function getRolesFromModule($moduleId){
        $moduleCommand = new GetRolesFromModuleCommand($moduleId);
        return $this->handler->handle($moduleCommand);
    }
}
