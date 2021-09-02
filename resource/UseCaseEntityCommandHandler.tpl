<?php

namespace ProyectoTAU\TAU\Module\Administration\%Entity%\Application\%usecase%;

use ProyectoTAU\TAU\Module\Administration\%Entity%\Domain\%Entity%;
use ProyectoTAU\TAU\Module\Administration\%Entity%\Domain\%Entity%Repository;

final class %Usecase%%Entity%CommandHandler
{
    private $%entity%Repository;

    public function __construct(%Entity%Repository $%entity%Repository)
    {
        $this->%entity%Repository = $%entity%Repository;
    }

    public function handle(%Usecase%%Entity%Command $command) // TODO type %Entity% if read
    {
        %return_if_read% $this->%entity%Repository->%usecase%(%usecase_params%);
    }
}
