<?php

namespace ProyectoTAU\TAU\Module\Administration\Role\Domain;

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
final class Role
{
    use PropertiesBag;
    use SettersBag;

     public function __construct($id, $name, $desc)
     {
        $this->setPropertiesBag(['id', 'name', 'desc']);
        $this->setSettersBag($this->getPropertiesBag());

        $this->setId($id);
        $this->setName($name);
        $this->setDesc($desc);
     }
}
