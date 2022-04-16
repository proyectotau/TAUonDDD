<?php

namespace ProyectoTAU\TAU\Module\Administration\Group\Application;

use ProyectoTAU\TAU\Module\Administration\User\Domain\User;

final class GroupService
{
    public static function create($id, $name, $desc)
    {
        app()->add('ProyectoTAU\TAU\Module\Administration\Group\Application\create\CreateGroupCommandHandler',
            new \ProyectoTAU\TAU\Module\Administration\Group\Application\create\CreateGroupCommandHandler(
                app()->get('ProyectoTAU\TAU\Module\Administration\Group\Domain\GroupRepository')
            )
        );

        app('Joselfonseca\LaravelTactician\CommandBusInterface')->handle(
            new \ProyectoTAU\TAU\Module\Administration\Group\Application\create\CreateGroupCommand($id, $name, $desc)
        );
    }

    public static function delete($id)
    {
        app()->add('ProyectoTAU\TAU\Module\Administration\Group\Application\delete\DeleteGroupCommandHandler',
            new \ProyectoTAU\TAU\Module\Administration\Group\Application\delete\DeleteGroupCommandHandler(
                app()->get('ProyectoTAU\TAU\Module\Administration\Group\Domain\UserRepository')
            )
        );

        app('Joselfonseca\LaravelTactician\CommandBusInterface')->handle(
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

        app('Joselfonseca\LaravelTactician\CommandBusInterface')->handle(
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

        app('Joselfonseca\LaravelTactician\CommandBusInterface')->handle(
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

        app('Joselfonseca\LaravelTactician\CommandBusInterface')->handle(
            new \ProyectoTAU\TAU\Module\Administration\Group\Application\removeUserFromGroup\RemoveUserFromGroupCommand($userId, $groupId)
        );
    }

    //TODO: Move to Query
    public static function read($id): User
    {
        app()->add('ProyectoTAU\TAU\Module\Administration\Group\Application\read\ReadGroupCommandHandler',
            new \ProyectoTAU\TAU\Module\Administration\Group\Application\read\ReadGroupCommandHandler(
                app()->get('ProyectoTAU\TAU\Module\Administration\Group\Domain\GroupRepository')
            )
        );

        return app('Joselfonseca\LaravelTactician\CommandBusInterface')->handle(
            new \ProyectoTAU\TAU\Module\Administration\Group\Application\read\ReadGroupCommand($id)
        );
    }

    //TODO: Move to Query
    public static function getUsersFromGroup($groupId): array
    {
        app()->add('ProyectoTAU\TAU\Module\Administration\Group\Application\getUsersFromGroup\GetUsersFromGroupCommandHandler',
            new \ProyectoTAU\TAU\Module\Administration\Group\Application\getUsersFromGroup\GetUsersFromGroupCommandHandler(
                app()->get('ProyectoTAU\TAU\Module\Administration\Group\Domain\GroupRepository')
            )
        );

        return app('Joselfonseca\LaravelTactician\CommandBusInterface')->handle(
            new \ProyectoTAU\TAU\Module\Administration\Group\Application\getUsersFromGroup\GetUsersFromGroupCommand($groupId)
        );
    }
}
