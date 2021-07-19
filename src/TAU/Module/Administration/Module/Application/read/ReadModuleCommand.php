<?php

namespace ProyectoTAU\TAU\Module\Administration\Module\Application\read;

final class ReadModuleCommand
{
    public $id;

    public function __construct($id)
    {
        $this->id = $id;
    }
}
