<?php

namespace ProyectoTAU\TAU\Module\Administration\User\Application\destroy;


class UserDestroyCommand
{
    public $id;

    public function __construct($id)
    {
        $this->id = $id;
    }
}