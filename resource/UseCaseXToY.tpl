<?php

namespace ProyectoTAU\TAU\Module\Administration\%EntityY%\Application\%usecase%%EntityX%To%EntityY%;

use ProyectoTAU\TAU\Module\Administration\%EntityX%\Domain\%EntityX%Repository;
use ProyectoTAU\TAU\Module\Administration\%EntityY%\Domain\%EntityY%Repository;

final class %Usecase%%EntityX%To%EntityY%
{
    private $%entityX%Repository;
    private $%entityY%Repository;
    private $handler;

    public function __construct(%EntityX%Repository $%entityX%, %EntityY%Repository $%entityY%)
    {
        $this->%entityX%Repository = $%entityX%;
        $this->%entityY%Repository = $%entityY%;
        $this->handler = new %Usecase%%EntityX%To%EntityY%CommandHandler($%entityX%, $%entityY%);
    }

    public function %usecase%%EntityX%To%EntityY%($%entityX%Id, $%entityY%Id){
        $%entityY%Command = new %Usecase%%EntityX%To%EntityY%Command($%entityX%Id, $%entityY%Id);
        $this->handler->handle($%entityY%Command);
    }
}
