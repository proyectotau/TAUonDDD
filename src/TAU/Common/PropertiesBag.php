<?php

namespace ProyectoTAU\TAU\Common;

trait PropertiesBag
{
    private $attributes = [];
	private $data = [];

	protected function setPropertiesBag($attributes)
    {
        $this->attributes = $attributes;
    }

    protected function getPropertiesBag()
    {
        return $this->attributes;
    }

    protected function propertiesBagToString(): string
    {
        $s = '';
        foreach ($this->attributes as $attr)
        {
            $s .= $attr . ': ' . $this->$attr . "\n";
        }
        return $s;
    }

    protected function isPropertyAllowed($name): bool
    {
        return in_array($name, $this->attributes, true);
    }

    /**
     * @param $name
     * @return bool
     */
    protected function isDefined($name): bool
    {
        return array_key_exists($name, $this->data);
    }

	public function __set($name, $value)
    {
        if( ! $this->isPropertyAllowed($name) ) {
            $trace = debug_backtrace();
            trigger_error(
                'Disallowed property ' . $name .
                ' in ' . $trace[0]['file'] .
                ' on line ' . $trace[0]['line'],
                E_USER_NOTICE);
            return null;
        }

        $this->data[$name] = $value;
    }
	
	public function __get($name)
    {
        if( ! $this->isPropertyAllowed($name) ) {
            $trace = debug_backtrace();
            trigger_error(
                'Disallowed property ' . $name .
                ' in ' . $trace[0]['file'] .
                ' on line ' . $trace[0]['line'],
                E_USER_NOTICE);
            return null;
        }

        if( ! $this->isDefined($name)) {
            $trace = debug_backtrace();
            trigger_error(
                'Undefined property ' . $name .
                ' in ' . $trace[0]['file'] .
                ' on line ' . $trace[0]['line'],
                E_USER_NOTICE);
            return null;
        }

        return $this->data[$name];
    }
	
	public function __isset($name)
    {
        if( ! $this->isPropertyAllowed($name) ) {
            $trace = debug_backtrace();
            trigger_error(
                'Disallowed property ' . $name .
                ' in ' . $trace[0]['file'] .
                ' on line ' . $trace[0]['line'],
                E_USER_NOTICE);
            return null;
        }

        if( ! $this->isDefined($name)) {
            $trace = debug_backtrace();
            trigger_error(
                'Undefined property ' . $name .
                ' in ' . $trace[0]['file'] .
                ' on line ' . $trace[0]['line'],
                E_USER_NOTICE);
            return null;
        }

        return isset($this->data[$name]);
    }

    public function __unset($name)
    {
        if( ! $this->isPropertyAllowed($name) ) {
            $trace = debug_backtrace();
            trigger_error(
                'Disallowed property ' . $name .
                ' in ' . $trace[0]['file'] .
                ' on line ' . $trace[0]['line'],
                E_USER_NOTICE);
            return null;
        }

        if( ! $this->isDefined($name)) {
            $trace = debug_backtrace();
            trigger_error(
                'Undefined property ' . $name .
                ' in ' . $trace[0]['file'] .
                ' on line ' . $trace[0]['line'],
                E_USER_NOTICE);
            return null;
        }

        unset($this->data[$name]);
    }
}
