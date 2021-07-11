<?php

namespace ProyectoTAU\TAU\Module\Administration\Role\Application\update;

use ProyectoTAU\TAU\Module\Administration\Role\Domain\RoleRepository;

final class UpdateRoleCommandHandler
{
    private $roleRepository;

    public function __construct(RoleRepository $roleRepository)
    {
        $this->roleRepository = $roleRepository;
    }

    public function handle(UpdateRoleCommand $command)
    {
        $this->roleRepository->update($command->id, $command->name, $command->desc);
    }
}
