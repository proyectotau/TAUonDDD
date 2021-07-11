<?php

namespace ProyectoTAU\TAU\Common;

trait SettersBag
{
    private $setters = [];

    protected function setSettersBag($attributes)
    {
        foreach ($attributes as $value) {
            $v = ucwords(strtolower($value));
            $this->setters[] = 'set' . $v;
            $this->setters[] = 'get' . $v;
        }
    }

    protected function isSetterAllowed($name): bool
    {
        return in_array($name, $this->setters, true);
    }

    public function __call($name, $arguments)
    {
        $trace = debug_backtrace();
        if( ! $this->isSetterAllowed($name) ) {
            trigger_error(
                'Disallowed getter/setter ' . $name .
                ' in ' . $trace[0]['file'] .
                ' on line ' . $trace[0]['line'],
                E_USER_NOTICE);
            return null;
        }

        //echo "Llamando al método de objeto '$name' " . implode(', ', $arguments). "\n";

        $attribute = strtolower(substr($name, 3));
        if( substr($name, 0, 1) === 's' ){
            $this->$attribute = $arguments[0];
        } else {
            return $this->$attribute;
        }
    }
}
