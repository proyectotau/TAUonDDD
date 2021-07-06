<?php

namespace ProyectoTAU\TAU\Module\Administration\User\Application\create;

use ProyectoTAU\TAU\Module\Administration\User\Domain\Repository;

class UserCreateCommandHandler
{
    private $userRepository;

    public function __construct(Repository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function handle(UserCreateCommand $command)
    {
        $this->userRepository->save($command->id, $command->name, $command->surname, $command->login);
    }
}
