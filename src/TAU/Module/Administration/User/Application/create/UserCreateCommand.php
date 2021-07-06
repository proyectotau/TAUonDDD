<?php

namespace ProyectoTAU\TAU\Module\Administration\User\Application\create;

class UserCreateCommand
{
    public $id;
    public $name;
    public $surname;
    public $login;

    public function __construct($id, $name, $surname, $login)
    {
        $this->id = $id;
        $this->name = $name;
        $this->surname = $surname;
        $this->login = $login;
    }
}