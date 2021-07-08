<?php

namespace ProyectoTAU\TAU\Module\Administration\User\Domain;

/**
 * @method void setId($id)
 * @method void setName($name)
 * @method void setDesc($desc)
 */

use ProyectoTAU\TAU\Common\PropertiesBag;
use ProyectoTAU\TAU\Common\SettersBag;

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
