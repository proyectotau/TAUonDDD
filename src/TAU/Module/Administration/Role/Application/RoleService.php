<?php

namespace ProyectoTAU\TAU\Module\Administration\Role\Application;

use ProyectoTAU\TAU\Module\Administration\Role\Domain\Role;
use ProyectoTAU\TAU\Module\Administration\User\Domain\User;

final class RoleService
{
    public static function create($id, $name, $desc)
    {
        app()->add('ProyectoTAU\TAU\Module\Administration\Role\Application\create\CreateRoleCommandHandler',
            new \ProyectoTAU\TAU\Module\Administration\Role\Application\create\CreateRoleCommandHandler(
                app()->get('ProyectoTAU\TAU\Module\Administration\Role\Domain\RoleRepository')
            )
        );

        app('Joselfonseca\LaravelTactician\CommandBusInterface')->handle(
            new \ProyectoTAU\TAU\Module\Administration\Role\Application\create\CreateRoleCommand($id, $name, $desc)
        );
    }

    public static function delete($id)
    {
        app()->add('ProyectoTAU\TAU\Module\Administration\Role\Application\delete\DeleteRoleCommandHandler',
            new \ProyectoTAU\TAU\Module\Administration\Role\Application\delete\DeleteRoleCommandHandler(
                app()->get('ProyectoTAU\TAU\Module\Administration\Role\Domain\RoleRepository')
            )
        );

        app('Joselfonseca\LaravelTactician\CommandBusInterface')->handle(
            new \ProyectoTAU\TAU\Module\Administration\Role\Application\delete\DeleteRoleCommand($id)
        );
    }

    public static function update($id, $name, $desc)
    {
        app()->add('ProyectoTAU\TAU\Module\Administration\Role\Application\update\UpdateRoleCommandHandler',
            new \ProyectoTAU\TAU\Module\Administration\Role\Application\update\UpdateRoleCommandHandler(
                app()->get('ProyectoTAU\TAU\Module\Administration\Role\Domain\RoleRepository')
            )
        );

        app('Joselfonseca\LaravelTactician\CommandBusInterface')->handle(
            new \ProyectoTAU\TAU\Module\Administration\Role\Application\update\UpdateRoleCommand($id, $name, $desc)
        );
    }

    public static function addGroupToRole($groupId, $roleId)
    {
        app()->add('ProyectoTAU\TAU\Module\Administration\Role\Application\addGroupToRole\AddGroupToRoleCommandHandler',
            new \ProyectoTAU\TAU\Module\Administration\Role\Application\addGroupToRole\AddGroupToRoleCommandHandler(
                app()->get('ProyectoTAU\TAU\Module\Administration\Group\Domain\GroupRepository'),
                app()->get('ProyectoTAU\TAU\Module\Administration\Role\Domain\RoleRepository')
            )
        );

        app('Joselfonseca\LaravelTactician\CommandBusInterface')->handle(
            new \ProyectoTAU\TAU\Module\Administration\Role\Application\addGroupToRole\AddGroupToRoleCommand($groupId, $roleId)
        );
    }

    //TODO: Move to Query (rename Command to Query)
    public static function read($id): Role
    {
        app()->add('ProyectoTAU\TAU\Module\Administration\Role\Application\read\ReadRoleCommandHandler',
            new \ProyectoTAU\TAU\Module\Administration\Role\Application\read\ReadRoleCommandHandler(
                app()->get('ProyectoTAU\TAU\Module\Administration\Role\Domain\RoleRepository')
            )
        );

        return app('Joselfonseca\LaravelTactician\CommandBusInterface')->handle(
            new \ProyectoTAU\TAU\Module\Administration\Role\Application\read\ReadRoleCommand($id)
        );
    }

    public static function addModuleToRole($moduleId, $roleId)
    {
        app()->add('ProyectoTAU\TAU\Module\Administration\Role\Application\AddModuleToRole\AddModuleToRoleCommandHandler',
            new \ProyectoTAU\TAU\Module\Administration\Role\Application\AddModuleToRole\AddModuleToRoleCommandHandler(
                app()->get('ProyectoTAU\TAU\Module\Administration\Module\Domain\ModuleRepository'),
                app()->get('ProyectoTAU\TAU\Module\Administration\Role\Domain\RoleRepository')
            )
        );

        return app('Joselfonseca\LaravelTactician\CommandBusInterface')->handle(
            new \ProyectoTAU\TAU\Module\Administration\Role\Application\AddModuleToRole\AddModuleToRoleCommand($moduleId, $roleId)
        );
    }
}
