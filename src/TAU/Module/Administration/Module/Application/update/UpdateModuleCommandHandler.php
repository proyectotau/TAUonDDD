<?php

namespace ProyectoTAU\TAU\Module\Administration\Module\Application\update;

use ProyectoTAU\TAU\Module\Administration\Module\Domain\Module;
use ProyectoTAU\TAU\Module\Administration\Module\Domain\ModuleRepository;

final class UpdateModuleCommandHandler
{
    private $moduleRepository;

    public function __construct(ModuleRepository $moduleRepository)
    {
        $this->moduleRepository = $moduleRepository;
    }

    public function handle(UpdateModuleCommand $command)
    {
        $this->moduleRepository->update($command->id, $command->name, $command->desc);
    }
}
