<?php

namespace ProyectoTAU\TAU\Module\Administration\Group\Application\create;

final class CreateGroupCommand
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
