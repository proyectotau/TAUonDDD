<?php

namespace ProyectoTAU\TAU\Module\Administration\Role\Application\create;

use ProyectoTAU\TAU\Module\Administration\Role\Domain\Role;
use ProyectoTAU\TAU\Module\Administration\Role\Domain\RoleRepository;

final class CreateRoleCommandHandler
{
    private $roleRepository;

    public function __construct(RoleRepository $roleRepository)
    {
        $this->roleRepository = $roleRepository;
    }

    public function handle(CreateRoleCommand $command)
    {
        $this->roleRepository->create(new Role($command->id, $command->name, $command->desc));
    }
}
