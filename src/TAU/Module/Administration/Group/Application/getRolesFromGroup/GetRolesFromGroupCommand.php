<?php

namespace ProyectoTAU\TAU\Module\Administration\Group\Application\getRolesFromGroup;

use ProyectoTAU\TAU\Module\Administration\Group\Domain\Group;

final class GetRolesFromGroupCommand
{
    public $group;

    public function __construct(Group $group)
    {
        $this->group = $group;
    }
}
