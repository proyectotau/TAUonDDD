<?php

namespace ProyectoTAU\TAU\Module\Administration\User\Domain;

use ProyectoTAU\TAU\Common\PropertiesBag;
use ProyectoTAU\TAU\Common\SettersBag;

/**
 * @method void setId(int $id)
 * @method void setName(string $name)
 * @method void setDesc(string $desc)
 */
class Group
{
    use PropertiesBag;
    use SettersBag;

    private $magicMethods;

     public function __construct($id, $name, $desc)
     {
         $this->setPropertiesBag(array('id', 'name', 'desc', 'campo'));
         $this->setSettersBag($this->getPropertiesBag());

         $this->setId($id);
         $this->setName($name);
         $this->setDesc($desc);

         /*$this->id  = $id;
         $this->name = $name;
         $this->desc = $desc;*/
     }
}
