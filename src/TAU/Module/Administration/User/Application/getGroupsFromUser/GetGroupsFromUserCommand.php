<?php

namespace ProyectoTAU\TAU\Module\Administration\User\Application\getGroupsFromUser;

use ProyectoTAU\TAU\Module\Administration\User\Domain\User;

final class GetGroupsFromUserCommand
{
    public $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }
}
