<?php

namespace ProyectoTAU\TAU\Module\Administration\Role\Domain;

use ProyectoTAU\TAU\Module\Administration\Group\Domain\Group;

trait RoleUseCases
{
    private $groups = [];
    private $modules = [];

    public function addGroup($group)
    {
        $this->groups[$group->getId()] = $group;
        // TODO: RaiseAddGroupToRoleDomainEvent($group, $this)
    }


    public function removeGroup(Group $group)
    {
        unset($this->groups[$group->getId()]);
        // TODO: RaiseRemoveGroupFromRoleDomainEvent($group, $this)
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
