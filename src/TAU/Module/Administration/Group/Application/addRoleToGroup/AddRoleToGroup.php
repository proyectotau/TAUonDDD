<?php

namespace ProyectoTAU\TAU\Module\Administration\Group\Application\addRoleToGroup;

use ProyectoTAU\TAU\Module\Administration\Role\Domain\RoleRepository;
use ProyectoTAU\TAU\Module\Administration\Group\Domain\GroupRepository;
use ProyectoTAU\TAU\Module\Administration\Role\Application\read\ReadRole;
use ProyectoTAU\TAU\Module\Administration\Group\Application\read\ReadGroup;

final class AddRoleToGroup
{
    private $handler;
    private $roleRepository;
    private $groupRepository;

    public function __construct(RoleRepository $role, GroupRepository $group)
    {
        $this->roleRepository = $role;
        $this->groupRepository = $group;
        $this->handler = new AddRoleToGroupCommandHandler($role, $group);
    }

    public function addRoleToGroup($roleId, $groupId){
        $roleService = new ReadRole($this->roleRepository);
        $role = $roleService->read($roleId);

        $groupService = new ReadGroup($this->groupRepository);
        $group = $groupService->read($groupId);

        $groupCommand = new AddRoleToGroupCommand($role, $group);
        $this->handler->handle($groupCommand);
    }
}
