<?php
/*
 * Autogenerated by
 * php tools/makeUseCaseEntity.php %Usecase% %Entity% %fields%
 */
namespace ProyectoTAU\TAU\Module\Administration\%Entity%\Application\%usecase%;

use ProyectoTAU\TAU\Module\Administration\%Entity%\Domain\%Entity%Repository; // TODO first use must be the Repository
%use_entity_if_read%

final class %Usecase%%Entity%
{
    private $bus;

    public function __construct(%Entity%Repository $%entity%){
        $this->bus = app('CommandBus');

        app()->bind('%fcer%',
            function () use ($%entity%){
                return  $%entity%;
            });

        $this->bus->addHandler('%fcns%\%Usecase%%Entity%Command',
                               '%fcns%\%Usecase%%Entity%CommandHandler');
}

    public function %usecase%(%param_attributes%)%return_entity_if_read%
    {
        %return_if_read% $this->bus->dispatch('%fcns%\%Usecase%%Entity%Command',
        [
%array_attributes%
        ], []);
    }
}
