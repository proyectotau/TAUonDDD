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
        $r = $this->moduleRepository->getRolesFromModule($command->module);

        $module = $command->module;
        $module->getRoles();

        return $r;
    }
}
