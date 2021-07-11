<?php

namespace ProyectoTAU\TAU\Module\Administration\Role\Application\delete;

use ProyectoTAU\TAU\Module\Administration\Role\Domain\RoleRepository;

final class DeleteRoleCommandHandler
{
    private $roleRepository;

    public function __construct(RoleRepository $roleRepository)
    {
        $this->roleRepository = $roleRepository;
    }

    public function handle(DeleteRoleCommand $command)
    {
        $this->roleRepository->delete($command->id);
    }
}
