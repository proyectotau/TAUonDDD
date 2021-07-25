<?php

namespace ProyectoTAU\TAU\Module\Administration\Module\Application\getRolesFromModule;

final class GetRolesFromModuleCommand
{
    public $moduleId;

    public function __construct($moduleId)
    {
        $this->moduleId = $moduleId;
    }
}
