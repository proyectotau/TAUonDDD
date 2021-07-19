<?php

namespace ProyectoTAU\TAU\Module\Administration\%EntityY%\Application\%usecase%%EntityX%sFrom%EntityY%;

use ProyectoTAU\TAU\Module\Administration\%EntityY%\Domain\%EntityY%Repository;
use ProyectoTAU\TAU\Module\Administration\%EntityY%\Application\read\Read%EntityY%;

final class %Usecase%%EntityX%sFrom%EntityY%
{
    private $handler;
    private $%entityY%Repository;

    public function __construct(%EntityY%Repository $%entityY%)
    {
        $this->%entityY%Repository = $%entityY%;
        $this->handler = new %Usecase%%EntityX%sFrom%EntityY%CommandHandler($%entityY%);
    }

    public function %usecase%%EntityX%sFrom%EntityY%($%entityY%Id){
        $%entityY%Service = new Read%EntityY%($this->%entityY%Repository);
        $%entityY% = $%entityY%Service->read($%entityY%Id);

        $%entityY%Command = new %Usecase%%EntityX%sFrom%EntityY%Command($%entityY%);
        return $this->handler->handle($%entityY%Command);
    }
}
