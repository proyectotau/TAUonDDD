<?php

namespace ProyectoTAU\TAU\Module\Administration\%EntityY%\Application\%usecase%%EntityX%To%EntityY%;

use ProyectoTAU\TAU\Module\Administration\%EntityX%\Domain\%EntityX%;
use ProyectoTAU\TAU\Module\Administration\%EntityY%\Domain\%EntityY%;

final class %Usecase%%EntityX%To%EntityY%Command
{
    public $%entityX%;
    public $%entityY%;

    public function __construct(%EntityX% $%entityX%, %EntityY% $%entityY%)
    {
        $this->%entityX% = $%entityX%;
        $this->%entityY% = $%entityY%;
    }
}
