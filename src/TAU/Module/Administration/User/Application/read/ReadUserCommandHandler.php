<?php

namespace ProyectoTAU\TAU\Module\Administration\User\Application\read;

use ProyectoTAU\TAU\Module\Administration\User\Domain\UserRepository;

final class ReadUserCommandHandler
{
    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function handle(ReadUserCommand $command)
    {
        $this->userRepository->read($command->id);
    }
}
