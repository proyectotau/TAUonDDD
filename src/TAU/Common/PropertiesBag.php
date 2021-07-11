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

    protected function isPropertyAllowed($name): bool
    {
        return in_array($name, $this->attributes, true);
    }

    /**
     * @param $name
     * @return bool
     */
    protected function defined($name): bool
    {
        return array_key_exists($name, $this->data);
    }

	public function __set($name, $value)
    {
        $trace = debug_backtrace();
        if( ! $this->isPropertyAllowed($name) ) {
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
        $trace = debug_backtrace();
        if( ! $this->isPropertyAllowed($name) ) {
            trigger_error(
                'Disallowed property ' . $name .
                ' in ' . $trace[0]['file'] .
                ' on line ' . $trace[0]['line'],
                E_USER_NOTICE);
            return null;
        }

        if( ! $this->defined($name)) {
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
        $trace = debug_backtrace();
        if( ! $this->isPropertyAllowed($name) ) {
            trigger_error(
                'Disallowed property ' . $name .
                ' in ' . $trace[0]['file'] .
                ' on line ' . $trace[0]['line'],
                E_USER_NOTICE);
            return null;
        }

        if( ! $this->defined($name)) {
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
        $trace = debug_backtrace();
        if( ! $this->isPropertyAllowed($name) ) {
            trigger_error(
                'Disallowed property ' . $name .
                ' in ' . $trace[0]['file'] .
                ' on line ' . $trace[0]['line'],
                E_USER_NOTICE);
            return null;
        }

        if( ! $this->defined($name)) {
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
