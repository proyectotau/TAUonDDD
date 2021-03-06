<?php

namespace ProyectoTAU\TAU\Module\Administration\User\Domain;

use ProyectoTAU\TAU\Module\Administration\Group\Domain\Group;

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
        $this->belongsto[$group->getId()] = $group;
        // TODO: Raise AddGroupToUserDomainEvent($this, $group)
        //$user->addGroup($this); //TODO: this causes an infinite loop
    }

    public function removeGroup(Group $group)
    {
        unset($this->belongsto[$group->getId()]);
        // TODO: Raise RemoveGroupFromUserDomainEvent($role, $this)
    }

    public function getGroups(): array
    {
        return $this->belongsto;
    }

    public function equals($o): bool
    {
        return $this->getid()       == $o->getid()
            && $this->getName()     == $o->getName()
            && $this->getSurname()  == $o->getSurname()
            && $this->getLogin()    == $o->getLogin();
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
