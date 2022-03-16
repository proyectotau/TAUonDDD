<?php

namespace ProyectoTAU\Tests\Integration\App;

use ReflectionClass;
use ReflectionException;

/*class PseudoApp
{
    private array $map = [];

    public function bind($cls, $alias)
    {
        $this->map[$cls] = $alias;
    }

    public function get($cls)
    {
        return $this->map[$cls];
    }
}*/

class PseudoApp //Container implements ContainerInterface
{
    private $services = [];

    public function get($id)
    {
        $item = $this->resolve($id);
        if (!($item instanceof ReflectionClass)) {
            return $item;
        }
        return $this->getInstance($item);
    }

    public function has($id)
    {
        try {
            $item = $this->resolve($id);
        } catch (/*NotFound*/\Exception $e) {
            return false;
        }
        if ($item instanceof ReflectionClass) {
            return $item->isInstantiable();
        }
        return isset($item);
    }

    public function bind(string $key, $value)
    {
        $this->services[$key] = $value;
        return $this;
    }

    private function resolve($id)
    {
        try {
            $name = $id;
            if (isset($this->services[$id])) {
                $name = $this->services[$id];
                if (is_callable($name)) {
                    return $name();
                }
                if( is_object($name)){
                    return $name;
                }
            }
            return (new ReflectionClass($name));
        } catch (ReflectionException $e) {
            throw new \NotFoundException($e->getMessage(), $e->getCode(), $e);
        }
    }

    private function getInstance(ReflectionClass $item)
    {
        $constructor = $item->getConstructor();
        if (is_null($constructor) || $constructor->getNumberOfRequiredParameters() == 0) {
            return $item->newInstance();
        }
        $params = [];
        foreach ($constructor->getParameters() as $param) {
            if ($type = $param->getType()) {
                $params[] = $this->get($type->getName());
            }
        }
        return $item->newInstanceArgs($params);
    }
}
