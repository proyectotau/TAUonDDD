<?php

namespace ProyectoTAU\TAU\Module\Administration\Group\Application\addUserToGroup;

use ProyectoTAU\TAU\Module\Administration\User\Domain\User;
use ProyectoTAU\TAU\Module\Administration\Group\Domain\Group;

final class AddUserToGroupCommand
{
    public $userId;
    public $groupId;

    public function __construct($userId, $groupId)
    {
        $this->userId = $userId;
        $this->groupId = $groupId;
    }
}
