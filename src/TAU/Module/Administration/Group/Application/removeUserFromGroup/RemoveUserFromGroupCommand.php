<?php

namespace ProyectoTAU\TAU\Module\Administration\Group\Application\removeUserFromGroup;

class RemoveUserFromGroupCommand
{
public $userId;
public $groupId;

    public function __construct($userId, $groupId)
    {
        $this->userId = $userId;
        $this->groupId = $groupId;
    }
}
