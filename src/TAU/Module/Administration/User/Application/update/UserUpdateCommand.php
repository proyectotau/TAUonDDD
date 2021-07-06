<?php
/**
 * Created by PhpStorm.
 * User: Usuario
 * Date: 06/07/2021
 * Time: 23:56
 */

namespace ProyectoTAU\TAU\Module\Administration\User\Application\update;


class UserUpdateCommand
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