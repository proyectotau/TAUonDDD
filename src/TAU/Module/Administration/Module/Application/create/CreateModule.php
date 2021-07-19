<?php

namespace ProyectoTAU\TAU\Module\Administration\Module\Application\create;

use ProyectoTAU\TAU\Module\Administration\Module\Domain\ModuleRepository;

final class CreateModule
{
    private $handler;

    public function __construct(ModuleRepository $module){
        $this->handler = new CreateModuleCommandHandler($module);
    }

	public function create($id, $name, $desc){
		$moduleCommand = new CreateModuleCommand($id, $name, $desc);
		$this->handler->handle($moduleCommand);
	}
}
