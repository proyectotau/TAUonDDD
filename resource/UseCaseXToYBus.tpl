<?php
/*
 * Autogenerated by
 * php tools/makeUseCaseXtoY.php %Usecase% %EntityX% %EntityY%
 */
namespace ProyectoTAU\TAU\Module\Administration\%EntityY%\Application\%usecase%%EntityX%To%EntityY%;

use ProyectoTAU\TAU\Module\Administration\%EntityX%\Domain\%EntityX%Repository;
use ProyectoTAU\TAU\Module\Administration\%EntityY%\Domain\%EntityY%Repository;

final class %Usecase%%EntityX%To%EntityY%
{
    private $bus;

    public function __construct(%EntityX%Repository $%entityX%, %EntityY%Repository $%entityY%)
    {
        $this->bus = app('Joselfonseca\LaravelTactician\CommandBusInterface');

        app()->bind('%fcerX%',
            function () use ($%entityX%){
                return  $%entityX%;
            });

        app()->bind('%fcerY%',
            function () use ($%entityY%){
                return  $%entityY%;
            });

        $this->bus->addHandler('%fcns%\%Usecase%%EntityX%To%EntityY%Command',
                               '%fcns%\%Usecase%%EntityX%To%EntityY%CommandHandler');
        }

    public function %usecase%%EntityX%To%EntityY%($%entityX%Id, $%entityY%Id)
    {
        $this->bus->dispatch('%fcns%\%Usecase%%EntityX%To%EntityY%Command',
        [
            "%entityX%Id" => $%entityX%Id,
            "%entityY%Id" => $%entityY%Id
        ], []);
    }
}
