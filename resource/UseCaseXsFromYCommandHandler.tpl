<?php

namespace ProyectoTAU\TAU\Module\Administration\%EntityY%\Application\%usecase%%EntityX%sFrom%EntityY%;

use ProyectoTAU\TAU\Module\Administration\%EntityY%\Domain\%EntityY%Repository;

final class %Usecase%%EntityX%sFrom%EntityY%CommandHandler
{
    private $%entityY%Repository;

    public function __construct(%EntityY%Repository $%entityY%)
    {
        $this->%entityY%Repository = $%entityY%;
    }

    public function handle(%Usecase%%EntityX%sFrom%EntityY%Command $command)
    {
        $r = $this->%entityY%Repository->%usecase%%EntityX%sFrom%EntityY%($command->%entityY%);

        $%entityY% = $command->%entityY%;
        $%entityY%->%usecase%%EntityX%s();

        return $r;
    }
}
