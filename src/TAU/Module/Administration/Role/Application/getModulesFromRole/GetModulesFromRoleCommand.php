<?php

namespace ProyectoTAU\TAU\Module\Administration\Role\Application\getModulesFromRole;

final class GetModulesFromRoleCommand
{
    public $roleId;

    public function __construct($roleId)
    {
        $this->roleId = $roleId;
    }
}
