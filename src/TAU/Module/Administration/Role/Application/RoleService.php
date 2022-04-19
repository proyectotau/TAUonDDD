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

        app('CommandBus')->handle(
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

        app('CommandBus')->handle(
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

        app('CommandBus')->handle(
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

        app('CommandBus')->handle(
            new \ProyectoTAU\TAU\Module\Administration\Role\Application\addGroupToRole\AddGroupToRoleCommand($groupId, $roleId)
        );
    }

    public static function removeGroupFromRole($groupId, $roleId)
    {
        app()->add('ProyectoTAU\TAU\Module\Administration\Role\Application\removeGroupFromRole\RemoveGroupFromRoleCommandHandler',
            new \ProyectoTAU\TAU\Module\Administration\Role\Application\removeGroupFromRole\RemoveGroupFromRoleCommandHandler(
                app()->get('ProyectoTAU\TAU\Module\Administration\Group\Domain\GroupRepository'),
                app()->get('ProyectoTAU\TAU\Module\Administration\Role\Domain\RoleRepository')
            )
        );

        app('CommandBus')->handle(
            new \ProyectoTAU\TAU\Module\Administration\Role\Application\removeGroupFromRole\RemoveGroupFromRoleCommand($groupId, $roleId)
        );
    }

    public static function removeModuleFromRole($moduleId, $roleId)
    {
        app()->add('ProyectoTAU\TAU\Module\Administration\Role\Application\removeModuleFromRole\RemoveModuleFromRoleCommandHandler',
            new \ProyectoTAU\TAU\Module\Administration\Role\Application\removeModuleFromRole\RemoveModuleFromRoleCommandHandler(
                app()->get('ProyectoTAU\TAU\Module\Administration\Module\Domain\ModuleRepository'),
                app()->get('ProyectoTAU\TAU\Module\Administration\Role\Domain\RoleRepository')
            )
        );

        app('CommandBus')->handle(
            new \ProyectoTAU\TAU\Module\Administration\Role\Application\removeModuleFromRole\RemoveModuleFromRoleCommand($moduleId, $roleId)
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

        return app('CommandBus')->handle(
            new \ProyectoTAU\TAU\Module\Administration\Role\Application\read\ReadRoleCommand($id)
        );
    }

    public static function addModuleToRole($moduleId, $roleId)
    {
        app()->add('ProyectoTAU\TAU\Module\Administration\Role\Application\addModuleToRole\AddModuleToRoleCommandHandler',
            new \ProyectoTAU\TAU\Module\Administration\Role\Application\addModuleToRole\AddModuleToRoleCommandHandler(
                app()->get('ProyectoTAU\TAU\Module\Administration\Module\Domain\ModuleRepository'),
                app()->get('ProyectoTAU\TAU\Module\Administration\Role\Domain\RoleRepository')
            )
        );

        app('CommandBus')->handle(
            new \ProyectoTAU\TAU\Module\Administration\Role\Application\addModuleToRole\AddModuleToRoleCommand($moduleId, $roleId)
        );
    }

    /*
     * TODO: Move to Query
     */
    public static function getGroupsFromRole($roleId): array
    {
        app()->add('ProyectoTAU\TAU\Module\Administration\Role\Application\getGroupsFromRole\GetGroupsFromRoleCommandHandler',
            new \ProyectoTAU\TAU\Module\Administration\Role\Application\getGroupsFromRole\GetGroupsFromRoleCommandHandler(
                app()->get('ProyectoTAU\TAU\Module\Administration\Role\Domain\RoleRepository'
                )
            )
        );

        return app('CommandBus')->handle(
            new \ProyectoTAU\TAU\Module\Administration\Role\Application\getGroupsFromRole\GetGroupsFromRoleCommand($roleId)
        );
    }

    /*
    * TODO: Move to Query
    */
    public static function getModulesFromRole($roleId): array
    {
        app()->add('ProyectoTAU\TAU\Module\Administration\Role\Application\getModulesFromRole\GetModulesFromRoleCommandHandler',
            new \ProyectoTAU\TAU\Module\Administration\Role\Application\getModulesFromRole\GetModulesFromRoleCommandHandler(
                app()->get('ProyectoTAU\TAU\Module\Administration\Role\Domain\RoleRepository'
                )
            )
        );

        return app('CommandBus')->handle(
            new \ProyectoTAU\TAU\Module\Administration\Role\Application\getModulesFromRole\GetModulesFromRoleCommand($roleId)
        );
    }
}
