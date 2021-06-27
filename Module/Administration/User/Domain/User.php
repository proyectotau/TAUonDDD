<?php

namespace TAU\Module\Administration\User\Domain;

final class User
{
    private $id;
    private $name;
    private $surname;
    private $login;

    public function __construct($id, $name, $surname, $login)
    {
        $this->setId($id);
        $this->setName($name);
        $this->setSurname($surname);
        $this->setLogin($login);
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setSurname($surname)
    {
        $this->surname = $surname;
    }

    public function getSurname()
    {
        return $this->surname;
    }

    public function setLogin($login)
    {
        $this->login = $login;
    }

    public function getLogin()
    {
        return $this->login;
    }
}