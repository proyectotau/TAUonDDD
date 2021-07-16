<?php

namespace ProyectoTAU\TAU\Module\Administration\Group\Application\addUserToGroup;

use ProyectoTAU\TAU\Module\Administration\User\Domain\User;
use ProyectoTAU\TAU\Module\Administration\Group\Domain\Group;

final class AddUserToGroupCommand
{
    public $user;
    public $group;

    public function __construct(User $user, Group $group)
    {
        $this->user = $user;
        $this->group = $group;
    }
}
