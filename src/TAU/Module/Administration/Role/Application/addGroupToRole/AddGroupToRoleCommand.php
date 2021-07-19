<?php

namespace ProyectoTAU\TAU\Module\Administration\Role\Application\addGroupToRole;

use ProyectoTAU\TAU\Module\Administration\Group\Domain\Group;
use ProyectoTAU\TAU\Module\Administration\Role\Domain\Role;

final class AddGroupToRoleCommand
{
    public $group;
    public $role;

    public function __construct(Group $group, Role $role)
    {
        $this->group = $group;
        $this->role = $role;
    }
}
