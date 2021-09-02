<?php

namespace ProyectoTAU\TAU\Module\Administration\%Entity%\Application\%usecase%;

use ProyectoTAU\TAU\Module\Administration\%Entity%\Domain\%Entity%Repository;

final class %Usecase%%Entity%
{
    private $handler;

    public function __construct(%Entity%Repository $%entity%){
        $this->handler = new %Usecase%%Entity%CommandHandler($%entity%);
    }

    public function %usecase%(%param_attributes%){
        $%entity%Command = new %Usecase%%Entity%Command(%param_attributes%);
        $this->handler->handle($%entity%Command);
    }
}
