<?php

namespace ProyectoTAU\TAU\Module\Administration\Group\Application\getUsersFromGroup;

final class GetUsersFromGroupCommand
{
    public $groupId;

    public function __construct($groupId)
    {
        $this->groupId = $groupId;
    }
}
