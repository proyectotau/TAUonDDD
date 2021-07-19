<?php

namespace ProyectoTAU\TAU\Module\Administration\Group\Application\addRoleToGroup;

use ProyectoTAU\TAU\Module\Administration\Role\Domain\RoleRepository;
use ProyectoTAU\TAU\Module\Administration\Group\Domain\GroupRepository;

final class AddRoleToGroupCommandHandler
{
    private $roleRepository;
    private $groupRepository;

    public function __construct(RoleRepository $role, GroupRepository $group)
    {
        $this->roleRepository = $role;
        $this->groupRepository = $group;
    }

    public function handle(AddRoleToGroupCommand $command)
    {
        $this->groupRepository->addRoleToGroup($command->role, $command->group);

        $role = $command->role;
        $group = $command->group;
        $group->addRole($role);
    }
}
