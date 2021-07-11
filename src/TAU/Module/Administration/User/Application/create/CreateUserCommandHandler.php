<?php

namespace ProyectoTAU\TAU\Module\Administration\User\Application\create;

use ProyectoTAU\TAU\Module\Administration\User\Domain\UserRepository;

final class CreateUserCommandHandler
{
    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function handle(CreateUserCommand $command)
    {
        $this->userRepository->create($command->id, $command->name, $command->surname, $command->login);
    }
}
