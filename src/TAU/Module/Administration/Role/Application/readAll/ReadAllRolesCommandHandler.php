<?php

namespace ProyectoTAU\TAU\Module\Administration\Role\Application\readAll;

use ProyectoTAU\TAU\Module\Administration\Role\Domain\RoleRepository;

final class ReadAllRolesCommandHandler
{
    private $roleRepository;

    public function __construct(RoleRepository $roleRepository)
    {
        $this->roleRepository = $roleRepository;
    }

    public function handle(ReadAllRolesCommand $command): array
    {
        return $this->roleRepository->readAll();
    }
}
