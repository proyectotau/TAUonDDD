<?php

namespace ProyectoTAU\TAU\Module\Administration\%EntityY%\Application\%usecase%%EntityX%To%EntityY%;

use ProyectoTAU\TAU\Module\Administration\%EntityX%\Domain\%EntityX%Repository;
use ProyectoTAU\TAU\Module\Administration\%EntityY%\Domain\%EntityY%Repository;
use ProyectoTAU\TAU\Module\Administration\%EntityX%\Application\read\Read%EntityX%;
use ProyectoTAU\TAU\Module\Administration\%EntityY%\Application\read\Read%EntityY%;

final class %Usecase%%EntityX%To%EntityY%
{
    private $handler;
    private $%entityX%Repository;
    private $%entityY%Repository;

    public function __construct(%EntityX%Repository $%entityX%, %EntityY%Repository $%entityY%)
    {
        $this->%entityX%Repository = $%entityX%;
        $this->%entityY%Repository = $%entityY%;
        $this->handler = new %Usecase%%EntityX%To%EntityY%CommandHandler($%entityX%, $%entityY%);
    }

    public function %usecase%%EntityX%To%EntityY%($%entityX%Id, $%entityY%Id){
        $%entityX%Service = new Read%EntityX%($this->%entityX%Repository);
        $%entityX% = $%entityX%Service->read($%entityX%Id);

        $%entityY%Service = new Read%EntityY%($this->%entityY%Repository);
        $%entityY% = $%entityY%Service->read($%entityY%Id);

        $%entityY%Command = new %Usecase%%EntityX%To%EntityY%Command($%entityX%, $%entityY%);
        $this->handler->handle($%entityY%Command);
    }
}
