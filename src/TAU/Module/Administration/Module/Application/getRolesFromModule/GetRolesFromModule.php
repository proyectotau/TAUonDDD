<?php

namespace ProyectoTAU\TAU\Module\Administration\Module\Application\getRolesFromModule;

use ProyectoTAU\TAU\Module\Administration\Module\Domain\ModuleRepository;
use ProyectoTAU\TAU\Module\Administration\Module\Application\read\ReadModule;

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
        $moduleService = new ReadModule($this->moduleRepository);
        $module = $moduleService->read($moduleId);

        $moduleCommand = new GetRolesFromModuleCommand($module);
        return $this->handler->handle($moduleCommand);
    }
}
