<?php

namespace ProyectoTAU\TAU\Module\Administration\User\Application\update;

use ProyectoTAU\TAU\Module\Administration\User\Domain\UserRepository;

final class UpdateUserCommandHandler
{
    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function handle(UpdateUserCommand $command)
    {
        $this->userRepository->update($command->id, $command->name, $command->surname, $command->login);
    }
}
