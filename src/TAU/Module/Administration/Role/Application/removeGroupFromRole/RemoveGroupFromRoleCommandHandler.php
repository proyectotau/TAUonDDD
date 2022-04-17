<?php

namespace ProyectoTAU\TAU\Module\Administration\Role\Application\removeGroupFromRole;

use ProyectoTAU\TAU\Module\Administration\Group\Domain\GroupRepository;
use ProyectoTAU\TAU\Module\Administration\Role\Domain\RoleRepository;

final class RemoveGroupFromRoleCommandHandler
{
    private $groupRepository;
    private $roleRepository;

    public function __construct(GroupRepository $group, RoleRepository $role)
    {
        $this->groupRepository = $group;
        $this->roleRepository = $role;
    }

    public function handle(RemoveGroupFromRoleCommand $command)
    {
        $group = $this->groupRepository->read($command->groupId);
        $role = $this->roleRepository->read($command->roleId);

        $this->roleRepository->removeGroupFromRole($group, $role); //TODO: remove must use id only, do not read

        $role->removeGroup($group);
    }
}
