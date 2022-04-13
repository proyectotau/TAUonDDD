<?php

namespace ProyectoTAU\TAU\Module\Administration\User\Application;

use ProyectoTAU\TAU\Module\Administration\User\Domain\User;

final class UserService
{
    public static function create($id, $name, $surname, $login)
    {
        app()->add('ProyectoTAU\TAU\Module\Administration\User\Application\create\CreateUserCommandHandler',
            new \ProyectoTAU\TAU\Module\Administration\User\Application\create\CreateUserCommandHandler(
                app()->get('ProyectoTAU\TAU\Module\Administration\User\Domain\UserRepository')
            )
        );

        app('Joselfonseca\LaravelTactician\CommandBusInterface')->handle(
            new \ProyectoTAU\TAU\Module\Administration\User\Application\create\CreateUserCommand($id, $name, $surname, $login)
        );
    }

    public static function delete($id)
    {
        app()->add('ProyectoTAU\TAU\Module\Administration\User\Application\delete\DeleteUserCommandHandler',
            new \ProyectoTAU\TAU\Module\Administration\User\Application\delete\DeleteUserCommandHandler(
                app()->get('ProyectoTAU\TAU\Module\Administration\User\Domain\UserRepository')
            )
        );

        app('Joselfonseca\LaravelTactician\CommandBusInterface')->handle(
            new \ProyectoTAU\TAU\Module\Administration\User\Application\delete\DeleteUserCommand($id)
        );
    }

    public static function update($id, $name, $surname, $login)
    {
        app()->add('ProyectoTAU\TAU\Module\Administration\User\Application\update\UpdateUserCommandHandler',
            new \ProyectoTAU\TAU\Module\Administration\User\Application\update\UpdateUserCommandHandler(
                app()->get('ProyectoTAU\TAU\Module\Administration\User\Domain\UserRepository')
            )
        );

        app('Joselfonseca\LaravelTactician\CommandBusInterface')->handle(
            new \ProyectoTAU\TAU\Module\Administration\User\Application\update\UpdateUserCommand($id, $name, $surname, $login)
        );
    }

    public static function addGroupToUser($groupId, $userId)
    {
        app()->add('ProyectoTAU\TAU\Module\Administration\User\Application\addGroupToUser\AddGroupToUserCommandHandler',
            new \ProyectoTAU\TAU\Module\Administration\User\Application\addGroupToUser\AddGroupToUserCommandHandler(
                app()->get('ProyectoTAU\TAU\Module\Administration\Group\Domain\GroupRepository'),
                app()->get('ProyectoTAU\TAU\Module\Administration\User\Domain\UserRepository')
            )
        );

        app('Joselfonseca\LaravelTactician\CommandBusInterface')->handle(
            new \ProyectoTAU\TAU\Module\Administration\User\Application\addGroupToUser\AddGroupToUserCommand($groupId, $userId)
        );
    }

    //TODO: Move to Query (rename Command to Query)
    public static function read($id): User
    {
        app()->add('ProyectoTAU\TAU\Module\Administration\User\Application\read\ReadUserCommandHandler',
            new \ProyectoTAU\TAU\Module\Administration\User\Application\read\ReadUserCommandHandler(
                app()->get('ProyectoTAU\TAU\Module\Administration\User\Domain\UserRepository')
            )
        );

        return app('Joselfonseca\LaravelTactician\CommandBusInterface')->handle(
            new \ProyectoTAU\TAU\Module\Administration\User\Application\read\ReadUserCommand($id)
        );
    }

    //TODO: Move to Query
    public static function getGroupsFromUser($userId): array
    {
        app()->add('ProyectoTAU\TAU\Module\Administration\User\Application\getGroupsFromUser\GetGroupsFromUserCommandHandler',
            new \ProyectoTAU\TAU\Module\Administration\User\Application\getGroupsFromUser\GetGroupsFromUserCommandHandler(
                app()->get('ProyectoTAU\TAU\Module\Administration\User\Domain\UserRepository')
            )
        );

        return app('Joselfonseca\LaravelTactician\CommandBusInterface')->handle(
            new \ProyectoTAU\TAU\Module\Administration\User\Application\getGroupsFromUser\GetGroupsFromUserCommand($userId)
        );
    }
}
