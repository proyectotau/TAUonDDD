<?php

namespace ProyectoTAU\TAU\Module\Administration\User\Application\removeGroupFromUser;

final class RemoveGroupFromUserCommand
{
    public $groupId;
    public $userId;

    public function __construct($groupId, $userId)
    {
        $this->groupId = $groupId;
        $this->userId = $userId;
    }
}
