<?php

namespace ProyectoTAU\TAU\Module\Administration\Module\Application\update;

use ProyectoTAU\TAU\Module\Administration\Module\Domain\ModuleRepository;

final class UpdateModule
{
    private $handler;

    public function __construct(ModuleRepository $module){
        $this->handler = new UpdateModuleCommandHandler($module);
    }

	public function update($id, $name, $desc){
		$moduleCommand = new UpdateModuleCommand($id, $name, $desc);
		$this->handler->handle($moduleCommand);
	}
}
