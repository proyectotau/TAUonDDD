<?php

namespace ProyectoTAU\TAU\Module\Administration\Role\Application\addGroupToRole;

use ProyectoTAU\TAU\Module\Administration\Group\Domain\GroupRepository;
use ProyectoTAU\TAU\Module\Administration\Role\Domain\RoleRepository;

final class AddGroupToRole
{
    private $groupRepository;
    private $roleRepository;
    private $handler;

    public function __construct(GroupRepository $group, RoleRepository $role)
    {
        $this->groupRepository = $group;
        $this->roleRepository = $role;
        $this->handler = new AddGroupToRoleCommandHandler($group, $role);
    }

    public function addGroupToRole($groupId, $roleId){
        $roleCommand = new AddGroupToRoleCommand($groupId, $roleId);
        $this->handler->handle($roleCommand);
    }
}
