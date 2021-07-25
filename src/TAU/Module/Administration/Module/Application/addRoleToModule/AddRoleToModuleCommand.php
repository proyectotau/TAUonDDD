<?php

namespace ProyectoTAU\TAU\Module\Administration\Module\Application\addRoleToModule;

use ProyectoTAU\TAU\Module\Administration\Role\Domain\Role;
use ProyectoTAU\TAU\Module\Administration\Module\Domain\Module;

final class AddRoleToModuleCommand
{
    public $roleId;
    public $moduleId;

    public function __construct($roleId, $moduleId)
    {
        $this->roleId = $roleId;
        $this->moduleId = $moduleId;
    }
}
