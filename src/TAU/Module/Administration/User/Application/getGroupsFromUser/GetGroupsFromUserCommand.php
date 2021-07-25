<?php

namespace ProyectoTAU\TAU\Module\Administration\User\Application\getGroupsFromUser;

final class GetGroupsFromUserCommand
{
    public $userId;

    public function __construct($userId)
    {
        $this->userId = $userId;
    }
}
