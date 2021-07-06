<?php

namespace ProyectoTAU\TAU\Module\Administration\User\Application\update;

use ProyectoTAU\TAU\Module\Administration\User\Domain\Repository;

class UserUpdateCommandHandler
{
    private $userRepository;

    public function __construct(Repository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function handle(UserUpdateCommand $command)
    {
        $this->userRepository->update($command->id, $command->name, $command->surname, $command->login);
    }
}