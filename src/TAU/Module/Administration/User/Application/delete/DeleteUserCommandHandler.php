<?php

namespace ProyectoTAU\TAU\Module\Administration\User\Application\delete;

use ProyectoTAU\TAU\Module\Administration\User\Domain\UserRepository;

final class DeleteUserCommandHandler
{
    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function handle(DeleteUserCommand $command)
    {
        $this->userRepository->delete($command->id);
    }
}
