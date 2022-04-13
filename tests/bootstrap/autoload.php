<?php

require __DIR__ . '/../../vendor/autoload.php';

use League\Tactician\CommandBus;
use ProyectoTAU\TAU\Common\CommandRunner;
use ProyectoTAU\TAU\Module\Administration\User\Infrastructure\InMemoryUserRepository;
use ProyectoTAU\TAU\Module\Administration\Group\Infrastructure\InMemoryGroupRepository;
use ProyectoTAU\TAU\Module\Administration\Role\Infrastructure\InMemoryRoleRepository;
use ProyectoTAU\TAU\Module\Administration\Module\Infrastructure\InMemoryModuleRepository;

/*
 * Instantiate all repositories
 */
app()->add('ProyectoTAU\TAU\Module\Administration\User\Domain\UserRepository', new InMemoryUserRepository());
app()->add('ProyectoTAU\TAU\Module\Administration\Group\Domain\GroupRepository', new InMemoryGroupRepository());
app()->add('ProyectoTAU\TAU\Module\Administration\Role\Domain\ModuleRepository', new InMemoryRoleRepository());
app()->add('ProyectoTAU\TAU\Module\Administration\Module\Domain\ModuleRepository', new InMemoryModuleRepository());

/*
 * Instantiate CommandBus
 */
app()->add('Joselfonseca\LaravelTactician\CommandBusInterface',
    new CommandBus(
        new CommandRunner()
    )
);
