<?php

namespace ProyectoTAU\TAU\Module\Administration\User\Application\read;

class UserReaderCommand
{
    public $id;

    public function __construct($id)
    {
        $this->id = $id;
    }
}