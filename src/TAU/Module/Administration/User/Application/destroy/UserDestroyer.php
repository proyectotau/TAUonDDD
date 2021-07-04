<?php

namespace ProyectoTAU\TAU\Module\Administration\User\Application\destroy;

use ProyectoTAU\TAU\Module\Administration\User\Domain\Repository;

final class UserDestroyer {

    private $userRepository;

    public function __construct(Repository $user){
        $this->userRepository = $user;
    }

    public function destroy($id){
        $this->userRepository->delete($id);
    }
}