<?php

namespace ProyectoTAU\TAU\Module\Administration\User\Application\addGroupToUser;

use ProyectoTAU\TAU\Module\Administration\Group\Domain\Group;
use ProyectoTAU\TAU\Module\Administration\User\Domain\User;

final class AddGroupToUserCommand
{
    public $group;
    public $user;

    public function __construct(Group $group, User $user)
    {
        $this->group = $group;
        $this->user = $user;
    }
}
