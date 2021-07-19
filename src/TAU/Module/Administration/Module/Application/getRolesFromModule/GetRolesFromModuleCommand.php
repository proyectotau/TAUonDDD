<?php

namespace ProyectoTAU\TAU\Module\Administration\Module\Application\getRolesFromModule;

use ProyectoTAU\TAU\Module\Administration\Module\Domain\Module;

final class GetRolesFromModuleCommand
{
    public $module;

    public function __construct(Module $module)
    {
        $this->module = $module;
    }
}
