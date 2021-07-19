<?php

namespace ProyectoTAU\TAU\Module\Administration\User\Domain;

class User
{
    private $id;
    private $name;
    private $surname;
    private $login;

    private $belongsto = [];

    public function __construct($id, $name, $surname, $login)
    {
        $this->setId($id);
        $this->setName($name);
        $this->setSurname($surname);
        $this->setLogin($login);

        // TODO: Raise CreateUserDomainEvent($this)
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

    public function addGroup($group)
    {
        $this->belongsto[] = $group;
        // TODO: Raise AddGroupToUserDomainEvent($this, $group)
    }

    public function getGroups(): array
    {
        return $this->belongsto;
    }

    public function __toString()
    {
        return
            "id: " . $this->id . "\n" .
            "name: " . $this->name . "\n" .
            "surname: " . $this->surname . "\n" .
            "login: " . $this->login . "\n";
    }
}
