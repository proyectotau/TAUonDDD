<?php

namespace ProyectoTAU\TAU\Common;

use League\Tactician\Middleware;

class Transactional implements Middleware
{
    private object $entityManager;

    public function __construct(object $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function execute(object $command, callable $next)
    {
        $this->entityManager->begin();

        try {

            $next($command);

        } catch (\Exception $e){
            $this->entityManager->rollback();
            throw $e;
        }

        $this->entityManager->commit();
    }
}
