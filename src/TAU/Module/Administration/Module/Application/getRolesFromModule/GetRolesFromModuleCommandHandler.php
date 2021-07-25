<?php

namespace ProyectoTAU\TAU\Module\Administration\Module\Application\getRolesFromModule;

use ProyectoTAU\TAU\Module\Administration\Module\Domain\ModuleRepository;

final class GetRolesFromModuleCommandHandler
{
    private $moduleRepository;

    public function __construct(ModuleRepository $module)
    {
        $this->moduleRepository = $module;
    }

    public function handle(GetRolesFromModuleCommand $command)
    {
        $module = $this->moduleRepository->read($command->moduleId);
        $r = $this->moduleRepository->getRolesFromModule($module);

        $module->getRoles();

        return $r;
    }
}
