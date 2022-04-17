<?php

namespace ProyectoTAU\TAU\Module\Administration\Group\Application\removeRoleFromGroup;


class RemoveRoleFromGroupCommand
{
    public $roleId;
    public $groupId;

    public function __construct($roleId, $groupId)
    {
        $this->roleId = $roleId;
        $this->groupId = $groupId;
    }
}
