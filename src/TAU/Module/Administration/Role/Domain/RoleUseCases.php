<?php

namespace ProyectoTAU\TAU\Module\Administration\Role\Domain;

trait RoleUseCases
{
    private $groups = [];
    private $modules = [];

    public function addGroup($group)
    {
        $this->groups[] = $group;
        // TODO: RaiseAddGroupToRoleDomainEvent($group, $this)
    }

    public function getGroups()
    {
        return $this->groups;
    }

    public function addModule($module)
    {
        $this->modules[] = $module;
        // TODO: RaiseAddModuleToRoleDomainEvent($module, $this)
    }

    public function getModules()
    {
        return $this->modules;
    }
}
