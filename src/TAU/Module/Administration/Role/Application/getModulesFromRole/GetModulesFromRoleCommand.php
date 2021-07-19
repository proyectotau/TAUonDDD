<?php

namespace ProyectoTAU\TAU\Module\Administration\Role\Application\getModulesFromRole;

use ProyectoTAU\TAU\Module\Administration\Role\Domain\Role;

final class GetModulesFromRoleCommand
{
    public $role;

    public function __construct(Role $role)
    {
        $this->role = $role;
    }
}
