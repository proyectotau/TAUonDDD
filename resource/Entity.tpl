<?php

namespace ProyectoTAU\TAU\Module\Administration\%Entity%\Domain;

use ProyectoTAU\TAU\Common\PropertiesBag;
use ProyectoTAU\TAU\Common\SettersBag;

%phpdoc_block%
class %Entity%
{
    use PropertiesBag;
    use SettersBag;

     public function __construct(%param_attributes%)
     {
        $this->setPropertiesBag([%$public_field_attributes%]);
        $this->setSettersBag($this->getPropertiesBag());

%this_setter_field%
     }
}
