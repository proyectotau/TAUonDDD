<?php

namespace ProyectoTAU\TAU\Module\Administration\Role\Application\read;

use ProyectoTAU\TAU\Module\Administration\Role\Domain\RoleRepository;

final class ReadRoleCommandHandler
{
    private $roleRepository;

    public function __construct(RoleRepository $roleRepository)
    {
        $this->roleRepository = $roleRepository;
    }

    public function handle(ReadRoleCommand $command)
    {
        $this->roleRepository->read($command->id);
    }
}
