<?php

namespace ProyectoTAU\TAU\Module\Administration\Module\Application\removeRoleFromModule;


final class RemoveRoleFromModuleCommand
{
    public $roleId;
    public $moduleId;

    public function __construct($roleId, $moduleId)
    {
        $this->roleId = $roleId;
        $this->moduleId = $moduleId;
    }
}
