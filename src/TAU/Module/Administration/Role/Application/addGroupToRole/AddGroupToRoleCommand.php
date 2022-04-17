<?php

namespace ProyectoTAU\TAU\Module\Administration\Role\Application\addGroupToRole;

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
