<?php

namespace ProyectoTAU\TAU\Module\Administration\User\Application\read;

final class ReadUserCommand
{
    public $id;

    public function __construct($id)
    {
        $this->id = $id;
    }
}
