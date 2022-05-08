<?php

require __DIR__ . '/../../vendor/autoload.php';

use League\Tactician\CommandBus;
use ProyectoTAU\TAU\Common\CommandRunner;
use ProyectoTAU\TAU\Common\QueryRunner;
use ProyectoTAU\TAU\Common\Transactional;

/*
 * Instantiate all repositories
 */


if( (bool)$_ENV['InMemory'] ) {
    $userRepository = $_ENV['InMemoryUserRepository'];
    $groupRepository = $_ENV['InMemoryGroupRepository'];
    $roleRepository = $_ENV['InMemoryRoleRepository'];
    $moduleRepository = $_ENV['InMemoryModuleRepository'];
    $entityManager = $_ENV['InMemoryEntityManager'];
} else {
    $userRepository = $_ENV['SQLiteUserRepository'];
    $groupRepository = $_ENV['SQLiteGroupRepository'];
    $roleRepository = $_ENV['SQLiteRoleRepository'];
    $moduleRepository = $_ENV['SQLiteModuleRepository'];
    $entityManager = $_ENV['SQLiteEntityManager'];
}

app()->add('ProyectoTAU\TAU\Module\Administration\User\Domain\UserRepository', new $userRepository);
app()->add('ProyectoTAU\TAU\Module\Administration\Group\Domain\GroupRepository', new $groupRepository);
app()->add('ProyectoTAU\TAU\Module\Administration\Role\Domain\RoleRepository', new $roleRepository);
app()->add('ProyectoTAU\TAU\Module\Administration\Module\Domain\ModuleRepository', new $moduleRepository);
app()->add('EntityManager', getConcrete($entityManager));

/*
 * Instantiate CommandBus
 */
app()->add('CommandBus',
    new CommandBus(
        new Transactional(
            app()->get('EntityManager')
        ),
        new CommandRunner()
    )
);

/*
 * Instantiate QueryBus
 */
app()->add('QueryBus',
    new CommandBus(
        new QueryRunner()
    )
);
