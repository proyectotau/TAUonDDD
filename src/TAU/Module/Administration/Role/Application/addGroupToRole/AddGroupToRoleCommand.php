<?php

namespace ProyectoTAU\TAU\Module\Administration\Role\Application\addGroupToRole;

use ProyectoTAU\TAU\Module\Administration\Group\Domain\Group;
use ProyectoTAU\TAU\Module\Administration\Role\Domain\Role;

final class AddGroupToRoleCommand
{
    public $groupId;
    public $roleId;

    public function __construct($groupId, $roleId)
    {
        $this->groupId = $groupId;
        $this->roleId = $roleId;
    }
}
