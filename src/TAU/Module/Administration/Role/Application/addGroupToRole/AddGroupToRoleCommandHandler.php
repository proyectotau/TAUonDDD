<?php

namespace ProyectoTAU\TAU\Module\Administration\Role\Application\addGroupToRole;

use ProyectoTAU\TAU\Module\Administration\Group\Domain\GroupRepository;
use ProyectoTAU\TAU\Module\Administration\Role\Domain\RoleRepository;

final class AddGroupToRoleCommandHandler
{
    private $groupRepository;
    private $roleRepository;

    public function __construct(GroupRepository $group, RoleRepository $role)
    {
        $this->groupRepository = $group;
        $this->roleRepository = $role;
    }

    public function handle(AddGroupToRoleCommand $command)
    {
        $this->roleRepository->addGroupToRole($command->group, $command->role);

        $group = $command->group;
        $role = $command->role;
        $role->addGroup($group);
    }
}
