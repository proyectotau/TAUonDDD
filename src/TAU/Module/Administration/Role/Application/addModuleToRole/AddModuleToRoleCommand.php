<?php

namespace ProyectoTAU\TAU\Module\Administration\Role\Application\addModuleToRole;

use ProyectoTAU\TAU\Module\Administration\Module\Domain\Module;
use ProyectoTAU\TAU\Module\Administration\Role\Domain\Role;

final class AddModuleToRoleCommand
{
    public $moduleId;
    public $roleId;

    public function __construct($moduleId, $roleId)
    {
        $this->moduleId = $moduleId;
        $this->roleId = $roleId;
    }
}
