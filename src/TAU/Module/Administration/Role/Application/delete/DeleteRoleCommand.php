<?php

namespace ProyectoTAU\TAU\Module\Administration\Role\Application\delete;

final class DeleteRoleCommand
{
    public $id;

    public function __construct($id)
    {
        $this->id = $id;
    }
}
