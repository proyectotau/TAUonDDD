<?php

namespace ProyectoTAU\TAU\Module\Administration\User\Application\read;

use ProyectoTAU\TAU\Module\Administration\User\Domain\Repository;

class UserReaderCommandHandler
{
    private $userRepository;

    public function __construct(Repository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function handle(UserReaderCommand $command)
    {
        $this->userRepository->read($command->id);
    }
}