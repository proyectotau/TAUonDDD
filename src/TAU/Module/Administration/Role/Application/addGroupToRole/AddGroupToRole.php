<?php

namespace ProyectoTAU\TAU\Module\Administration\Role\Application\addGroupToRole;

use ProyectoTAU\TAU\Module\Administration\Group\Domain\GroupRepository;
use ProyectoTAU\TAU\Module\Administration\Role\Domain\RoleRepository;
use ProyectoTAU\TAU\Module\Administration\Group\Application\read\ReadGroup;
use ProyectoTAU\TAU\Module\Administration\Role\Application\read\ReadRole;

final class AddGroupToRole
{
    private $handler;
    private $groupRepository;
    private $roleRepository;

    public function __construct(GroupRepository $group, RoleRepository $role)
    {
        $this->groupRepository = $group;
        $this->roleRepository = $role;
        $this->handler = new AddGroupToRoleCommandHandler($group, $role);
    }

    public function addGroupToRole($groupId, $roleId){
        $groupService = new ReadGroup($this->groupRepository);
        $group = $groupService->read($groupId);

        $roleService = new ReadRole($this->roleRepository);
        $role = $roleService->read($roleId);

        $roleCommand = new AddGroupToRoleCommand($group, $role);
        $this->handler->handle($roleCommand);
    }
}
