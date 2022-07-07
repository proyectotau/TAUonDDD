<?php

namespace ProyectoTAU\TAU\Module\Administration\Module\Application;

class ModuleService
{
    public static function create($id, $name, $desc)
    {
        app()->add('ProyectoTAU\TAU\Module\Administration\Module\Application\create\CreateModuleCommandHandler',
            new \ProyectoTAU\TAU\Module\Administration\Module\Application\create\CreateModuleCommandHandler(
                app()->get('ProyectoTAU\TAU\Module\Administration\Module\Domain\ModuleRepository')
            )
        );

        app('CommandBus')->handle(
            new \ProyectoTAU\TAU\Module\Administration\Module\Application\create\CreateModuleCommand($id, $name, $desc)
        );
    }

    public static function update($id, $name, $desc)
    {
        app()->add('ProyectoTAU\TAU\Module\Administration\Module\Application\update\UpdateModuleCommandHandler',
            new \ProyectoTAU\TAU\Module\Administration\Module\Application\update\UpdateModuleCommandHandler(
                app()->get('ProyectoTAU\TAU\Module\Administration\Module\Domain\ModuleRepository')
            )
        );

        app('CommandBus')->handle(
            new \ProyectoTAU\TAU\Module\Administration\Module\Application\update\UpdateModuleCommand($id, $name, $desc)
        );
    }

    public static function delete($moduleId)
    {
        app()->add('ProyectoTAU\TAU\Module\Administration\Module\Application\delete\DeleteModuleCommandHandler',
            new \ProyectoTAU\TAU\Module\Administration\Module\Application\delete\DeleteModuleCommandHandler(
                app()->get('ProyectoTAU\TAU\Module\Administration\Module\Domain\ModuleRepository')
            )
        );

        app('CommandBus')->handle(
            new \ProyectoTAU\TAU\Module\Administration\Module\Application\delete\DeleteModuleCommand($moduleId)
        );
    }

    public static function addRoleToModule($roleId, $moduleId)
    {
        app()->add('ProyectoTAU\TAU\Module\Administration\Module\Application\addRoleToModule\AddRoleToModuleCommandHandler',
            new \ProyectoTAU\TAU\Module\Administration\Module\Application\addRoleToModule\AddRoleToModuleCommandHandler(
                app()->get('ProyectoTAU\TAU\Module\Administration\Role\Domain\RoleRepository'),
                app()->get('ProyectoTAU\TAU\Module\Administration\Module\Domain\ModuleRepository')
            )
        );

        app('CommandBus')->handle(
            new \ProyectoTAU\TAU\Module\Administration\Module\Application\addRoleToModule\AddRoleToModuleCommand($roleId, $moduleId)
        );
    }

    public static function removeRoleFromModule($roleId, $moduleId)
    {
        app()->add('ProyectoTAU\TAU\Module\Administration\Module\Application\removeRoleFromModule\RemoveRoleFromModuleCommandHandler',
            new \ProyectoTAU\TAU\Module\Administration\Module\Application\removeRoleFromModule\RemoveRoleFromModuleCommandHandler(
                app()->get('ProyectoTAU\TAU\Module\Administration\Role\Domain\RoleRepository'),
                app()->get('ProyectoTAU\TAU\Module\Administration\Module\Domain\ModuleRepository')
            )
        );

        app('CommandBus')->handle(
            new \ProyectoTAU\TAU\Module\Administration\Module\Application\removeRoleFromModule\removeRoleFromModuleCommand($roleId, $moduleId)
        );
    }

    public static function read($id)
    {
        app()->add('ProyectoTAU\TAU\Module\Administration\Module\Application\read\ReadModuleCommandHandler',
            new \ProyectoTAU\TAU\Module\Administration\Module\Application\read\ReadModuleCommandHandler(
                app()->get('ProyectoTAU\TAU\Module\Administration\Module\Domain\ModuleRepository')
            )
        );

        return app('QueryBus')->handle(
            new \ProyectoTAU\TAU\Module\Administration\Module\Application\read\ReadModuleCommand($id)
        );
    }

    public static function readAll(): array
    {
        app()->add('ProyectoTAU\TAU\Module\Administration\Module\Application\readAll\ReadAllModulesCommandHandler',
            new \ProyectoTAU\TAU\Module\Administration\Module\Application\readAll\ReadAllModulesCommandHandler(
                app()->get('ProyectoTAU\TAU\Module\Administration\Module\Domain\ModuleRepository')
            )
        );

        return app('QueryBus')->handle(
            new \ProyectoTAU\TAU\Module\Administration\Module\Application\readAll\ReadAllModulesCommand()
        );
    }

    public static function getRolesFromModule($moduleId): array
    {
        app()->add('ProyectoTAU\TAU\Module\Administration\Module\Application\getRolesFromModule\GetRolesFromModuleCommandHandler',
            new \ProyectoTAU\TAU\Module\Administration\Module\Application\getRolesFromModule\GetRolesFromModuleCommandHandler(
                app()->get('ProyectoTAU\TAU\Module\Administration\Module\Domain\ModuleRepository')
            )
        );

        return app('QueryBus')->handle(
            new \ProyectoTAU\TAU\Module\Administration\Module\Application\getRolesFromModule\GetRolesFromModuleCommand($moduleId)
        );
    }
}
