<?php

namespace ProyectoTAU\TAU\Module\Administration\User\Application\readAll;

use ProyectoTAU\TAU\Module\Administration\User\Domain\User;
use ProyectoTAU\TAU\Module\Administration\User\Domain\UserRepository;

final class ReadAllUsersCommandHandler
{
    private $userRepository;
    //private $dataTransformer; // TODO QueryBus pending

    public function __construct(UserRepository $userRepository /*, DataTransformer $dataTransformer*/)
    {
        $this->userRepository = $userRepository;
        //$this->dataTransformer = $dataTransformer;
    }

    public function handle(ReadAllUsersCommand $command): array //| mixed
    {
        return //$this->dataTransformer->write(
            $this->userRepository->readAll()
        //)->read()
        ;
    }
}
