<?php

namespace ProyectoTAU\TAU\Module\Administration\Module\Application\readAll;

use ProyectoTAU\TAU\Module\Administration\Module\Domain\ModuleRepository;

final class ReadAllModulesCommandHandler
{
    private $moduleRepository;

    public function __construct(ModuleRepository $moduleRepository)
    {
        $this->moduleRepository = $moduleRepository;
    }

    public function handle(ReadAllModulesCommand $command): array
    {
        return $this->moduleRepository->readAll();
    }
}
