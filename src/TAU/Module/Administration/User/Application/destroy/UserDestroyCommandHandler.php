<?php

namespace ProyectoTAU\TAU\Module\Administration\User\Application\destroy;

use ProyectoTAU\TAU\Module\Administration\User\Domain\Repository;

class UserDestroyCommandHandler
{
    private $userRepository;

    public function __construct(Repository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function handle(UserDestroyCommand $command)
    {
        $this->userRepository->delete($command->id);
    }
}
