<?php

namespace ProyectoTAU\TAU\Module\Administration\Group\Application\getRolesFromGroup;

final class GetRolesFromGroupCommand
{
    public $groupId;

    public function __construct($groupId)
    {
        $this->groupId = $groupId;
    }
}
