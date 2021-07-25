<?php

namespace ProyectoTAU\TAU\Module\Administration\%EntityY%\Application\%usecase%%EntityX%To%EntityY%;

use ProyectoTAU\TAU\Module\Administration\%EntityX%\Domain\%EntityX%Repository;
use ProyectoTAU\TAU\Module\Administration\%EntityY%\Domain\%EntityY%Repository;

final class %Usecase%%EntityX%To%EntityY%CommandHandler
{
    private $%entityX%Repository;
    private $%entityY%Repository;

    public function __construct(%EntityX%Repository $%entityX%, %EntityY%Repository $%entityY%)
    {
        $this->%entityX%Repository = $%entityX%;
        $this->%entityY%Repository = $%entityY%;
    }

    public function handle(%Usecase%%EntityX%To%EntityY%Command $command)
    {
        $%entityX% = $this->%entityX%Repository->read($command->%entityX%Id);
        $%entityY% = $this->%entityY%Repository->read($command->%entityY%Id);

        $this->%entityY%Repository->%usecase%%EntityX%To%EntityY%($%entityX%, $%entityY%);

        $%entityY%->%usecase%%EntityX%($%entityX%);
    }
}
