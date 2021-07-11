<?php

namespace ProyectoTAU\TAU\Module\Administration\Group\Application\delete;

final class DeleteGroupCommand
{
    public $id;

    public function __construct($id)
    {
        $this->id = $id;
    }
}
