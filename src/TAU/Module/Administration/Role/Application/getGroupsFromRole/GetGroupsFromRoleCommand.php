<?php

namespace ProyectoTAU\TAU\Module\Administration\Role\Application\getGroupsFromRole;

use ProyectoTAU\TAU\Module\Administration\Role\Domain\Role;

final class GetGroupsFromRoleCommand
{
    public $role;

    public function __construct(Role $role)
    {
        $this->role = $role;
    }
}
