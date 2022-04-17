<?php

namespace ProyectoTAU\TAU\Module\Administration\Role\Application\removeGroupFromRole;

final class RemoveGroupFromRoleCommand
{
    public $groupId;
    public $roleId;

    public function __construct($groupId, $roleId)
    {
        $this->groupId = $groupId;
        $this->roleId = $roleId;
    }
}
