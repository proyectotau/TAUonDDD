<?php

namespace ProyectoTAU\TAU\Module\Administration\Role\Application\read;

final class ReadRoleCommand
{
    public $id;

    public function __construct($id)
    {
        $this->id = $id;
    }
}
