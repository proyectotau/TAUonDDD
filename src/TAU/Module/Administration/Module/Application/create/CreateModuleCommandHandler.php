<?php

namespace ProyectoTAU\TAU\Module\Administration\Module\Application\create;

use ProyectoTAU\TAU\Module\Administration\Module\Domain\Module;
use ProyectoTAU\TAU\Module\Administration\Module\Domain\ModuleRepository;

final class CreateModuleCommandHandler
{
    private $moduleRepository;

    public function __construct(ModuleRepository $moduleRepository)
    {
        $this->moduleRepository = $moduleRepository;
    }

    public function handle(CreateModuleCommand $command)
    {
        $this->moduleRepository->create(new Module($command->id, $command->name, $command->desc));
    }
}
