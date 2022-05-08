<?php

namespace ProyectoTAU\TAU\Module\Administration\Group\Application;

use ProyectoTAU\TAU\Module\Administration\Group\Domain\Group;

final class GroupService
{
    public static function create($id, $name, $desc)
    {
        app()->add('ProyectoTAU\TAU\Module\Administration\Group\Application\create\CreateGroupCommandHandler',
            new \ProyectoTAU\TAU\Module\Administration\Group\Application\create\CreateGroupCommandHandler(
                app()->get('ProyectoTAU\TAU\Module\Administration\Group\Domain\GroupRepository')
            )
        );

        app('CommandBus')->handle(
            new \ProyectoTAU\TAU\Module\Administration\Group\Application\create\CreateGroupCommand($id, $name, $desc)
        );
    }

    public static function delete($id)
    {
        app()->add('ProyectoTAU\TAU\Module\Administration\Group\Application\delete\DeleteGroupCommandHandler',
            new \ProyectoTAU\TAU\Module\Administration\Group\Application\delete\DeleteGroupCommandHandler(
                app()->get('ProyectoTAU\TAU\Module\Administration\Group\Domain\GroupRepository')
            )
        );

        app('CommandBus')->handle(
            new \ProyectoTAU\TAU\Module\Administration\Group\Application\delete\DeleteGroupCommand($id)
        );
    }

    public static function update($id, $name, $desc)
    {
        app()->add('ProyectoTAU\TAU\Module\Administration\Group\Application\update\UpdateGroupCommandHandler',
            new \ProyectoTAU\TAU\Module\Administration\Group\Application\update\UpdateGroupCommandHandler(
                app()->get('ProyectoTAU\TAU\Module\Administration\Group\Domain\GroupRepository')
            )
        );

        app('CommandBus')->handle(
            new \ProyectoTAU\TAU\Module\Administration\Group\Application\update\UpdateGroupCommand($id, $name, $desc)
        );
    }

    public static function addUserToGroup($userId, $groupId)
    {
        app()->add('ProyectoTAU\TAU\Module\Administration\Group\Application\addUserToGroup\AddUserToGroupCommandHandler',
            new \ProyectoTAU\TAU\Module\Administration\Group\Application\addUserToGroup\AddUserToGroupCommandHandler(
                app()->get('ProyectoTAU\TAU\Module\Administration\User\Domain\UserRepository'),
                app()->get('ProyectoTAU\TAU\Module\Administration\Group\Domain\GroupRepository')
            )
        );

        app('CommandBus')->handle(
            new \ProyectoTAU\TAU\Module\Administration\Group\Application\addUserToGroup\AddUserToGroupCommand($userId, $groupId)
        );
    }

    public static function removeUserFromGroup($userId, $groupId)
    {
        app()->add('ProyectoTAU\TAU\Module\Administration\Group\Application\removeUserFromGroup\RemoveUserFromGroupCommandHandler',
            new \ProyectoTAU\TAU\Module\Administration\Group\Application\removeUserFromGroup\RemoveUserFromGroupCommandHandler(
                app()->get('ProyectoTAU\TAU\Module\Administration\User\Domain\UserRepository'),
                app()->get('ProyectoTAU\TAU\Module\Administration\Group\Domain\GroupRepository')
            )
        );

        app('CommandBus')->handle(
            new \ProyectoTAU\TAU\Module\Administration\Group\Application\removeUserFromGroup\RemoveUserFromGroupCommand($userId, $groupId)
        );
    }

    public static function addRoleToGroup($roleId, $groupId)
    {
        app()->add('ProyectoTAU\TAU\Module\Administration\Group\Application\addRoleToGroup\AddRoleToGroupCommandHandler',
            new \ProyectoTAU\TAU\Module\Administration\Group\Application\addRoleToGroup\AddRoleToGroupCommandHandler(
                app()->get('ProyectoTAU\TAU\Module\Administration\Role\Domain\RoleRepository'),
                app()->get('ProyectoTAU\TAU\Module\Administration\Group\Domain\GroupRepository')
            )
        );

        app('CommandBus')->handle(
            new \ProyectoTAU\TAU\Module\Administration\Group\Application\addRoleToGroup\AddRoleToGroupCommand($roleId, $groupId)
        );
    }

    public static function read($id): Group
    {
        app()->add('ProyectoTAU\TAU\Module\Administration\Group\Application\read\ReadGroupCommandHandler',
            new \ProyectoTAU\TAU\Module\Administration\Group\Application\read\ReadGroupCommandHandler(
                app()->get('ProyectoTAU\TAU\Module\Administration\Group\Domain\GroupRepository')
            )
        );

        return app('QueryBus')->handle(
            new \ProyectoTAU\TAU\Module\Administration\Group\Application\read\ReadGroupCommand($id)
        );
    }

    public static function getUsersFromGroup($groupId): array
    {
        app()->add('ProyectoTAU\TAU\Module\Administration\Group\Application\getUsersFromGroup\GetUsersFromGroupCommandHandler',
            new \ProyectoTAU\TAU\Module\Administration\Group\Application\getUsersFromGroup\GetUsersFromGroupCommandHandler(
                app()->get('ProyectoTAU\TAU\Module\Administration\Group\Domain\GroupRepository')
            )
        );

        return app('QueryBus')->handle(
            new \ProyectoTAU\TAU\Module\Administration\Group\Application\getUsersFromGroup\GetUsersFromGroupCommand($groupId)
        );
    }

    public static function getRolesFromGroup($groupId)
    {
        app()->add('ProyectoTAU\TAU\Module\Administration\Group\Application\getRolesFromGroup\GetRolesFromGroupCommandHandler',
            new \ProyectoTAU\TAU\Module\Administration\Group\Application\getRolesFromGroup\GetRolesFromGroupCommandHandler(
                app()->get('ProyectoTAU\TAU\Module\Administration\Group\Domain\GroupRepository')
            )
        );

        return app('QueryBus')->handle(
            new \ProyectoTAU\TAU\Module\Administration\Group\Application\getRolesFromGroup\GetRolesFromGroupCommand($groupId)
        );
    }

    public static function removeRoleFromGroup($roleId, $groupId)
    {
        app()->add('ProyectoTAU\TAU\Module\Administration\Group\Application\removeRoleFromGroup\RemoveRoleFromGroupCommandHandler',
            new \ProyectoTAU\TAU\Module\Administration\Group\Application\removeRoleFromGroup\RemoveRoleFromGroupCommandHandler(
                app()->get('ProyectoTAU\TAU\Module\Administration\Role\Domain\RoleRepository'),
                app()->get('ProyectoTAU\TAU\Module\Administration\Group\Domain\GroupRepository')
            )
        );

        app('CommandBus')->handle(
            new \ProyectoTAU\TAU\Module\Administration\Group\Application\removeRoleFromGroup\RemoveRoleFromGroupCommand($roleId, $groupId)
        );
    }
}
