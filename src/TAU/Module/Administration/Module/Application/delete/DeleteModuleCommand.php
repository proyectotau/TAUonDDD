<?php

namespace ProyectoTAU\TAU\Module\Administration\Module\Application\delete;

final class DeleteModuleCommand
{
    public $id;

    public function __construct($id)
    {
        $this->id = $id;
    }
}
