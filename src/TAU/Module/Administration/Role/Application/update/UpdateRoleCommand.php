<?php

namespace ProyectoTAU\TAU\Module\Administration\Role\Application\update;

final class UpdateRoleCommand
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
