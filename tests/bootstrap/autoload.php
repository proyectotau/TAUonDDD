<?php

require __DIR__ . '/../../vendor/autoload.php';

use League\Tactician\CommandBus;
use ProyectoTAU\TAU\Common\CommandRunner;
use ProyectoTAU\TAU\Module\Administration\Group\Infrastructure\SQLiteGroupRepository;
use ProyectoTAU\TAU\Module\Administration\Module\Infrastructure\SQLiteModuleRepository;
use ProyectoTAU\TAU\Module\Administration\Role\Infrastructure\SQLiteRoleRepository;
use ProyectoTAU\TAU\Module\Administration\User\Infrastructure\InMemoryUserRepository;
use ProyectoTAU\TAU\Module\Administration\Group\Infrastructure\InMemoryGroupRepository;
use ProyectoTAU\TAU\Module\Administration\Role\Infrastructure\InMemoryRoleRepository;
use ProyectoTAU\TAU\Module\Administration\Module\Infrastructure\InMemoryModuleRepository;

use ProyectoTAU\TAU\Module\Administration\User\Infrastructure\SQLiteUserRepository;

/*
 * Instantiate all repositories
 */
//$userRepository = '\ProyectoTAU\TAU\Module\Administration\User\Infrastructure\\'.$_ENV['UserRepository'];
if(0) {
    app()->add('ProyectoTAU\TAU\Module\Administration\User\Domain\UserRepository', new InMemoryUserRepository());
    app()->add('ProyectoTAU\TAU\Module\Administration\Group\Domain\GroupRepository', new InMemoryGroupRepository());
    app()->add('ProyectoTAU\TAU\Module\Administration\Role\Domain\RoleRepository', new InMemoryRoleRepository());
    app()->add('ProyectoTAU\TAU\Module\Administration\Module\Domain\ModuleRepository', new InMemoryModuleRepository());
}else{
    app()->add('ProyectoTAU\TAU\Module\Administration\User\Domain\UserRepository', new SQLiteUserRepository());
    app()->add('ProyectoTAU\TAU\Module\Administration\Group\Domain\GroupRepository', new SQLiteGroupRepository());
    app()->add('ProyectoTAU\TAU\Module\Administration\Role\Domain\RoleRepository', new SQLiteRoleRepository());
    app()->add('ProyectoTAU\TAU\Module\Administration\Module\Domain\ModuleRepository', new SQLiteModuleRepository());
}
/*
 * Instantiate CommandBus
 */
app()->add('CommandBus',
    new CommandBus(
        new CommandRunner()
    )
);
