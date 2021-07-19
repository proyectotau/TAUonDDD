<?php

namespace ProyectoTAU\TAU\Module\Administration\Module\Application\delete;

use ProyectoTAU\TAU\Module\Administration\Module\Domain\ModuleRepository;

final class DeleteModule
{
    private $handler;

    public function __construct(ModuleRepository $module){
        $this->handler = new DeleteModuleCommandHandler($module);
    }

	public function delete($id){
		$moduleCommand = new DeleteModuleCommand($id);
		$this->handler->handle($moduleCommand);
	}
}
