<?php

namespace ProyectoTAU\TAU\Module\Administration\Module\Application\addRoleToModule;

use ProyectoTAU\TAU\Module\Administration\Role\Domain\Role;
use ProyectoTAU\TAU\Module\Administration\Module\Domain\Module;

final class AddRoleToModuleCommand
{
    public $role;
    public $module;

    public function __construct(Role $role, Module $module)
    {
        $this->role = $role;
        $this->module = $module;
    }
}
