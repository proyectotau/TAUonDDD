<?php

namespace ProyectoTAU\TAU\Module\Administration\Module\Domain;

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
class Module
{
    use PropertiesBag;
    use SettersBag;

    private $roles = [];

     public function __construct($id, $name, $desc)
     {
        $this->setPropertiesBag(['id', 'name', 'desc']);
        $this->setSettersBag($this->getPropertiesBag());

        $this->setId($id);
        $this->setName($name);
        $this->setDesc($desc);
		
		// TODO: Raise CreateModuleDomainEvent($this)
     }

    public function addRole($role)
    {
        $this->roles[] = $role;
        // TODO: Raise AddRoleToModuleDomainEvent($role, $this)
    }

    public function getRoles(): array
    {
        return $this->roles;
    }
}
