<?php

namespace ProyectoTAU\TAU\Module\Administration\%EntityY%\Application\%usecase%%EntityX%To%EntityY%;

use ProyectoTAU\TAU\Module\Administration\%EntityX%\Domain\%EntityX%;
use ProyectoTAU\TAU\Module\Administration\%EntityY%\Domain\%EntityY%;

final class %Usecase%%EntityX%To%EntityY%Command
{
    public $%entityX%Id;
    public $%entityY%Id;

    public function __construct($%entityX%Id, $%entityY%Id)
    {
        $this->%entityX%Id = $%entityX%Id;
        $this->%entityY%Id = $%entityY%Id;
    }
}
