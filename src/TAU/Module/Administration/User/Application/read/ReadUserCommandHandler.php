<?php

namespace ProyectoTAU\TAU\Module\Administration\User\Application\read;

use ProyectoTAU\TAU\Module\Administration\User\Domain\User;
use ProyectoTAU\TAU\Module\Administration\User\Domain\UserRepository;

final class ReadUserCommandHandler
{
    private $userRepository;
    //private $dataTransformer; // TODO QueryBus pending

    public function __construct(UserRepository $userRepository /*, DataTransformer $dataTransformer*/)
    {
        $this->userRepository = $userRepository;
        //$this->dataTransformer = $dataTransformer;
    }

    public function handle(ReadUserCommand $command): User //| mixed
    {
        return //$this->dataTransformer->write(
            $this->userRepository->read($command->id)
        //)->read()
        ;
    }
}
