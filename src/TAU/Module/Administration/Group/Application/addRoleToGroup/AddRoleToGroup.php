<?php

namespace ProyectoTAU\TAU\Module\Administration\Group\Application\addRoleToGroup;

use ProyectoTAU\TAU\Module\Administration\Role\Domain\RoleRepository;
use ProyectoTAU\TAU\Module\Administration\Group\Domain\GroupRepository;

final class AddRoleToGroup
{
    private $roleRepository;
    private $groupRepository;
    private $handler;

    public function __construct(RoleRepository $role, GroupRepository $group)
    {
        $this->roleRepository = $role;
        $this->groupRepository = $group;
        $this->handler = new AddRoleToGroupCommandHandler($role, $group);
    }

    public function addRoleToGroup($roleId, $groupId){
        $groupCommand = new AddRoleToGroupCommand($roleId, $groupId);
        $this->handler->handle($groupCommand);
    }
}
