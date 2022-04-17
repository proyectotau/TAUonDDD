<?php

namespace ProyectoTAU\TAU\Module\Administration\Group\Application\removeRoleFromGroup;

use ProyectoTAU\TAU\Module\Administration\Role\Domain\RoleRepository;
use ProyectoTAU\TAU\Module\Administration\Group\Domain\GroupRepository;

final class RemoveRoleFromGroupCommandHandler
{
    private $roleRepository;
    private $groupRepository;

    public function __construct(RoleRepository $role, GroupRepository $group)
    {
        $this->roleRepository = $role;
        $this->groupRepository = $group;
    }

    public function handle(RemoveRoleFromGroupCommand $command)
    {
        $role = $this->roleRepository->read($command->roleId);
        $group = $this->groupRepository->read($command->groupId);

        $this->groupRepository->removeRoleFromGroup($role, $group); //TODO: remove must use ID and GroupRoleRepository

        $group->removeRole($role);
    }
}
