<?php

namespace ProyectoTAU\TAU\Module\Administration\Module\Application\delete;

use ProyectoTAU\TAU\Module\Administration\Module\Domain\Module;
use ProyectoTAU\TAU\Module\Administration\Module\Domain\ModuleRepository;

final class DeleteModuleCommandHandler
{
    private $moduleRepository;

    public function __construct(ModuleRepository $moduleRepository)
    {
        $this->moduleRepository = $moduleRepository;
    }

    public function handle(DeleteModuleCommand $command)
    {
        $this->moduleRepository->delete($command->id);
    }
}
