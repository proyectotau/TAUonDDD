<?php

namespace ProyectoTAU\TAU\Common;

use League\Container\Definition\DefinitionAggregateInterface;
use League\Container\Definition\DefinitionInterface;
use League\Container\Inflector\InflectorAggregateInterface;
use League\Container\ServiceProvider\ServiceProviderAggregateInterface;

class ContainerExt extends \League\Container\Container
{

    public function __construct(
        DefinitionAggregateInterface $definitions = null,
        ServiceProviderAggregateInterface $providers = null,
        InflectorAggregateInterface $inflectors = null
    )
    {
        parent::__construct($definitions, $providers, $inflectors);
    }

    public function add(string $id, $concrete = null): DefinitionInterface
    {
        // \ProyectoTAU\TAU\Common\Logger::debug("$id ".var_export($concrete, true));

        if( $this->has($id, $concrete) ) // Replace concrete if id exists
        {
            $definition = $this->extend($id);
            $definition->setConcrete($concrete);
            return $definition;

        }

        return parent::add($id, $concrete);
    }
}
