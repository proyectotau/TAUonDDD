<?php

namespace ProyectoTAU\TAU\Module\Administration\User\Application\addGroupToUser;

final class AddGroupToUserCommand
{
    public $groupId;
    public $userId;

    public function __construct($groupId, $userId)
    {
        $this->groupId = $groupId;
        $this->userId = $userId;
    }
}
