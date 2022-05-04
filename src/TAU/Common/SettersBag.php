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
        //TODO: hack ;-(
        if( in_array($name, ['setPropertiesBag', 'setSettersBag'], true) ){
            $this->$name(...$arguments);
            return;
        }elseif( in_array($name, ['getPropertiesBag','getSettersBag'], true) ){
            return $this->$name(...$arguments);
        }

        if( ! $this->isSetterAllowed($name) ) {
            $trace = debug_backtrace();
            trigger_error(
                'Disallowed getter/setter ' . $name .
                ' in ' . $trace[0]['file'] .
                ' on line ' . $trace[0]['line'],
                E_USER_NOTICE);
            return null;
        }

        $attribute = strtolower(substr($name, 3));
        if($this->isSetter($name)){
            $this->$attribute = $arguments[0];
        } elseif( $this->isGetter($name) ) {
            return $this->$attribute;
        } else {
            $name(...$arguments);
        }
    }

    public function equals($o): bool
    {
        foreach ($this->setters as $getter){
            if( $this->isGetter($getter) )
            {
                if( $this->$getter() != $o->$getter() )
                    return false;
            }
        }
        return true;
    }

    private function isSetter($name): bool
    {
        return substr($name, 0, 3) === 'set';
    }

    private function isGetter($name): bool
    {
        return substr($name, 0, 3) === 'get';
    }
}
