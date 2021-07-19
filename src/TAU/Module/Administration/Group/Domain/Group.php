<?php

namespace ProyectoTAU\TAU\Module\Administration\Group\Domain;

use ProyectoTAU\TAU\Common\PropertiesBag;
use ProyectoTAU\TAU\Common\SettersBag;

/**
 * @method void setId(int $id)
 * @method int getId()
 * @method void setName(string $name)
 * @method string getName()
 * @method void setDesc(string $desc)
 * @method string getDesc()
 */
class Group
{
    use PropertiesBag;
    use SettersBag;


    private $members = [];
    private $authorizedBy = [];

     public function __construct($id, $name, $desc)
     {
        $this->setPropertiesBag(['id', 'name', 'desc']);
        $this->setSettersBag($this->getPropertiesBag());

        $this->setId($id);
        $this->setName($name);
        $this->setDesc($desc);

        // TODO: Raise CreateGroupDomainEvent($this)
     }

    public function addUser($user)
    {
        $this->members[] = $user;
        // TODO: Raise AddUserToGroupDomainEvent($user, $this)
    }

    public function getUsers(): array
    {
        return $this->members;
    }

    public function addRole($role)
    {
        $this->authorizedBy[] = $role;
        // TODO: Raise AddRoleToGroupDomainEvent($role, $this)
    }

    public function getRoles()
    {
        return $this->authorizedBy;
    }

    public function __toString()
    {
        return
            "id: " . $this->id . "\n" .
            "name: " . $this->name . "\n" .
            "desc: " . $this->desc . "\n";
    }
}
