<?php

namespace ProyectoTAU\TAU\Module\Administration\Group\Application\read;

final class ReadGroupCommand
{
    public $id;

    public function __construct($id)
    {
        $this->id = $id;
    }
}
