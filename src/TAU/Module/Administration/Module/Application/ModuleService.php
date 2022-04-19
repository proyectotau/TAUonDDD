<?php

namespace ProyectoTAU\TAU\Module\Administration\Module\Application;

class ModuleService
{

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

    //TODO: Move to Query
    public static function getRolesFromModule($moduleId): array
    {
        app()->add('ProyectoTAU\TAU\Module\Administration\Module\Application\getRolesFromModule\GetRolesFromModuleCommandHandler',
            new \ProyectoTAU\TAU\Module\Administration\Module\Application\getRolesFromModule\GetRolesFromModuleCommandHandler(
                app()->get('ProyectoTAU\TAU\Module\Administration\Module\Domain\ModuleRepository')
            )
        );

        return app('CommandBus')->handle(
            new \ProyectoTAU\TAU\Module\Administration\Module\Application\getRolesFromModule\GetRolesFromModuleCommand($moduleId)
        );
    }
}
