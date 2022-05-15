<?php

namespace ProyectoTAU\Tests\Integration\Services;

use League\Tactician\CommandBus;
use ProyectoTAU\TAU\Common\CommandRunner;
use ProyectoTAU\TAU\Common\InMemoryRepository;
use ProyectoTAU\TAU\Common\SQLiteRepository;
use ProyectoTAU\TAU\Common\Transactional;
use ProyectoTAU\TAU\Module\Administration\Group\Infrastructure\InMemoryGroupRepository;
use ProyectoTAU\TAU\Module\Administration\Group\Infrastructure\SQLiteGroupRepository;
use ProyectoTAU\TAU\Module\Administration\Module\Infrastructure\InMemoryModuleRepository;
use ProyectoTAU\TAU\Module\Administration\Module\Infrastructure\SQLiteModuleRepository;
use ProyectoTAU\TAU\Module\Administration\Role\Infrastructure\InMemoryRoleRepository;
use ProyectoTAU\TAU\Module\Administration\Role\Infrastructure\SQLiteRoleRepository;
use ProyectoTAU\TAU\Module\Administration\User\Infrastructure\InMemoryUserRepository;
use ProyectoTAU\TAU\Module\Administration\User\Infrastructure\SQLiteUserRepository;

trait RepositoriesProvider
{
    public function userRepositoryProvider(): array
    {
        return array(
            'InMemory User Repository' => [InMemoryRepository::getInstance(), new InMemoryUserRepository()],
            'SQLite User Repository' => [SQLiteRepository::getInstance(), new SQLiteUserRepository()]
        );
    }

    public function groupRepositoryProvider(): array
    {
        return array(
            'InMemory Group Repository' => [InMemoryRepository::getInstance(), new InMemoryGroupRepository()],
            'SQLite Group Repository' => [SQLiteRepository::getInstance(), new SQLiteGroupRepository()]
        );
    }

    public function roleRepositoryProvider(): array
    {
        return array(
            'InMemory Role Repository' => [InMemoryRepository::getInstance(), new InMemoryRoleRepository()],
            'SQLite Role Repository' => [SQLiteRepository::getInstance(), new SQLiteRoleRepository()]
        );
    }

    public function moduleRepositoryProvider(): array
    {
        return array(
            'InMemory Module Repository' => [InMemoryRepository::getInstance(), new InMemoryModuleRepository()],
            'SQLite Module Repository' => [SQLiteRepository::getInstance(), new SQLiteModuleRepository()]
        );
    }

    public function userGroupRepositoriesProvider(): array
    {
        return array(
            'InMemory User&Group Repositories' => [InMemoryRepository::getInstance(), new InMemoryUserRepository(), new InMemoryGroupRepository()],
            'SQLite User&Group Repositories' => [SQLiteRepository::getInstance(), new SQLiteUserRepository(), new SQLiteGroupRepository()]
        );
    }

    public function groupRoleRepositoriesProvider():array
    {
        return array(
            'InMemory Group&Role Repositories' => [InMemoryRepository::getInstance(), new InMemoryGroupRepository(), new InMemoryRoleRepository()],
            'SQLite Group&Role Repositories' => [SQLiteRepository::getInstance(), new SQLiteGroupRepository(), new SQLiteRoleRepository()]
        );
    }

    public function roleModuleRepositoriesProvider():array
    {
        return array(
            'InMemory Role&Module Repositories' => [InMemoryRepository::getInstance(), new InMemoryRoleRepository(), new InMemoryModuleRepository()],
            'SQLite Role&Module Repositories' => [SQLiteRepository::getInstance(), new SQLiteRoleRepository(), new SQLiteModuleRepository()]
        );
    }

    public function resetCommandBus($entityManager)
    {
        app()->add('EntityManager', $entityManager);

        /*
         * Re-eInstantiate CommandBus
         */

        app()->add('CommandBus',
            new CommandBus(
                new Transactional(
                    app()->get('EntityManager')
                ),
                new CommandRunner()
            )
        );
    }
}
