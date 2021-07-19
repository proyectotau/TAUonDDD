<?php

namespace ProyectoTAU\TAU\Module\Administration\Module\Application\read;

use ProyectoTAU\TAU\Module\Administration\Module\Domain\Module;
use ProyectoTAU\TAU\Module\Administration\Module\Domain\ModuleRepository;

final class ReadModuleCommandHandler
{
    private $moduleRepository;

    public function __construct(ModuleRepository $moduleRepository)
    {
        $this->moduleRepository = $moduleRepository;
    }

    public function handle(ReadModuleCommand $command): Module
    {
        return $this->moduleRepository->read($command->id);
    }
}
