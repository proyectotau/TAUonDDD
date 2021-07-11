<?php

namespace ProyectoTAU\TAU\Module\Administration\User\Application\delete;

final class DeleteUserCommand
{
    public $id;

    public function __construct($id)
    {
        $this->id = $id;
    }
}
