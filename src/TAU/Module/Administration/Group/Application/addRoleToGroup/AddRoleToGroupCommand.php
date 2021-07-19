<?php

namespace ProyectoTAU\TAU\Module\Administration\Group\Application\addRoleToGroup;

use ProyectoTAU\TAU\Module\Administration\Role\Domain\Role;
use ProyectoTAU\TAU\Module\Administration\Group\Domain\Group;

final class AddRoleToGroupCommand
{
    public $role;
    public $group;

    public function __construct(Role $role, Group $group)
    {
        $this->role = $role;
        $this->group = $group;
    }
}
