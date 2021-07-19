<?php

namespace ProyectoTAU\TAU\Module\Administration\Module\Application\create;

final class CreateModuleCommand
{
    public $id;
    public $name;
    public $desc;

    public function __construct($id, $name, $desc)
    {
        $this->id = $id;
        $this->name = $name;
        $this->desc = $desc;
    }
}
