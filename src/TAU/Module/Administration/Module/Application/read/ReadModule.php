<?php

namespace ProyectoTAU\TAU\Module\Administration\Module\Application\read;

use ProyectoTAU\TAU\Module\Administration\Module\Domain\Module;
use ProyectoTAU\TAU\Module\Administration\Module\Domain\ModuleRepository;

final class ReadModule
{
    private $handler;

    public function __construct(ModuleRepository $module){
        $this->handler = new ReadModuleCommandHandler($module);
    }

	public function read($id): Module
    {
		$moduleCommand = new ReadModuleCommand($id);
		return $this->handler->handle($moduleCommand);
	}
}
