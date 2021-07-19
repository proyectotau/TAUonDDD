<?php

namespace ProyectoTAU\TAU\Module\Administration\User\Application\DataTransformer;

use ProyectoTAU\TAU\Module\Administration\User\Domain\User;

interface DataTransformer
{
    public function write(User $user);

    public function read();
}
