<?php

namespace ProyectoTAU\TAU\Module\Administration\Role\Application\getGroupsFromRole;

final class GetGroupsFromRoleCommand
{
    public $roleId;

    public function __construct($roleId)
    {
        $this->roleId = $roleId;
    }
}
