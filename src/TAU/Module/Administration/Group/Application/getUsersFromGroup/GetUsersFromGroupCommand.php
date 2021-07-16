<?php

namespace ProyectoTAU\TAU\Module\Administration\Group\Application\getUsersFromGroup;

use ProyectoTAU\TAU\Module\Administration\Group\Domain\Group;

final class GetUsersFromGroupCommand
{
    public $group;

    public function __construct(Group $group)
    {
        $this->group = $group;
    }
}
