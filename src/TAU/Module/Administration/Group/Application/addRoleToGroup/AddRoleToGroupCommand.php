<?php

namespace ProyectoTAU\TAU\Module\Administration\Group\Application\addRoleToGroup;

use ProyectoTAU\TAU\Module\Administration\Role\Domain\Role;
use ProyectoTAU\TAU\Module\Administration\Group\Domain\Group;

final class AddRoleToGroupCommand
{
    public $roleId;
    public $groupId;

    public function __construct($roleId, $groupId)
    {
        $this->roleId = $roleId;
        $this->groupId = $groupId;
    }
}
