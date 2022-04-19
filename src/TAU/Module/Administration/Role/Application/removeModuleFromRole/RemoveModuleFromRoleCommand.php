<?php

namespace ProyectoTAU\TAU\Module\Administration\Role\Application\removeModuleFromRole;

final class RemoveModuleFromRoleCommand
{
    public $moduleId;
    public $roleId;

    public function __construct($moduleId, $roleId)
    {
        $this->moduleId = $moduleId;
        $this->roleId = $roleId;
    }
}
