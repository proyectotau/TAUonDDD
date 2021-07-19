<?php

namespace ProyectoTAU\TAU\Module\Administration\Role\Application\addModuleToRole;

use ProyectoTAU\TAU\Module\Administration\Module\Domain\Module;
use ProyectoTAU\TAU\Module\Administration\Role\Domain\Role;

final class AddModuleToRoleCommand
{
    public $module;
    public $role;

    public function __construct(Module $module, Role $role)
    {
        $this->module = $module;
        $this->role = $role;
    }
}
