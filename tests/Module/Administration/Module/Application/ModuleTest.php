<?php

namespace ProyectoTAU\Tests\Module\Administration\Module\Application;

use Mockery;
use Mockery\Adapter\Phpunit\MockeryTestCase;
use ProyectoTAU\TAU\Module\Administration\Module\Application\readAll\ReadAllModulesCommand;
use ProyectoTAU\TAU\Module\Administration\Module\Application\readAll\ReadAllModulesCommandHandler;
use ProyectoTAU\TAU\Module\Administration\Role\Domain\Role;
use ProyectoTAU\TAU\Module\Administration\Module\Domain\Module;
use ProyectoTAU\TAU\Module\Administration\Module\Domain\ModuleRepository;
use ProyectoTAU\TAU\Module\Administration\Module\Application\ModuleService;
use ProyectoTAU\TAU\Module\Administration\Module\Application\create\CreateModuleCommand;
use ProyectoTAU\TAU\Module\Administration\Module\Application\create\CreateModuleCommandHandler;
use ProyectoTAU\TAU\Module\Administration\Module\Application\read\ReadModuleCommand;
use ProyectoTAU\TAU\Module\Administration\Module\Application\read\ReadModuleCommandHandler;
use ProyectoTAU\TAU\Module\Administration\Module\Application\update\UpdateModuleCommand;
use ProyectoTAU\TAU\Module\Administration\Module\Application\update\UpdateModuleCommandHandler;
use ProyectoTAU\TAU\Module\Administration\Module\Application\delete\DeleteModuleCommand;
use ProyectoTAU\TAU\Module\Administration\Module\Application\delete\DeleteModuleCommandHandler;
use ProyectoTAU\Tests\Module\Administration\Group\Application\DummyGroupRepository;


class DummyModuleRepository implements ModuleRepository {

    public function clear(): void {}

    public function create(Module $module): void
    {
        // Should receive a call once with the same Dummy Module as argument
        if( ! ($module->getId() === 0 &&
            $module->getName() === 'Test' &&
            $module->getDesc() === 'Dummy') )
            throw new \InvalidArgumentException("Mismatched Module received by create method");
    }

    public function read($id): Module
    {
        // Should receive a call with id === 0
        if( ! ($id === 0) ) {
            throw new \InvalidArgumentException("Mismatched Module received by read method");
        }
        return new Module(0,null,null);
    }

    public function readAll(): array
    {
        return [
            new Module(0,null, null),
            new Module(1,null, null)
        ];
    }

    public function update($id, $name, $desc): void
    {
        // Should receive a call once with the same Dummy Module as argument
        if( ! ($id === 0 &&
            $name === 'Test' &&
            $desc === 'Dummy') )
            throw new \InvalidArgumentException("Mismatched Module received by update method");
    }

    public function delete($id): void
    {
        // Should receive a call with id === 0
        if( ! ($id === 0) ) {
            throw new \InvalidArgumentException("Mismatched Module received by delete method");
        }
    }

    public function addRoleToModule(Role $role, Module $module): void {}
    public function removeRoleFromModule(Role $role, Module $module): void {}
    public function getRolesFromModule(Module $module): array {return [];}
}

class ModuleTest extends MockeryTestCase
{
    public function mockeryTestTearDown()
    {
        Mockery::close();
    }

    public function testItCanCreateAdminModule()
    {
        $moduleRepository = Mockery::mock(DummyModuleRepository::class);

        $moduleRepository->shouldReceive('create')
            ->once()
            ->with(\Hamcrest\Core\IsEqual::equalTo(
                new Module(0, "Test", "Dummy")));

        //ModuleService::create(0, "Test", "Dummy");

        $handler = new CreateModuleCommandHandler($moduleRepository);
        $handler->handle(new CreateModuleCommand(0, "Test", "Dummy"));
    }

    public function testItCanReadAdminModule()
    {
        $moduleRepository = Mockery::mock(DummyModuleRepository::class);

        $moduleRepository->shouldReceive('read')->once()->with(0);

        //ModuleService::read(0);

        $handler = new ReadModuleCommandHandler($moduleRepository);
        $handler->handle(new ReadModuleCommand(0));
    }

    public function testItCanReadAllAdminModules()
    {
        $moduleRepository = Mockery::mock(DummyModuleRepository::class);

        $moduleRepository->shouldReceive('readAll')->once();

        //ModuleService::readAll();

        $handler = new ReadAllModulesCommandHandler($moduleRepository);
        $handler->handle(new ReadAllModulesCommand());
    }

    public function testItCanUpdateAdminModule()
    {
        $moduleRepository = Mockery::mock(DummyModuleRepository::class);

        $moduleRepository->shouldReceive('update')->once()->with(0, "Test", "Dummy");

        //ModuleService::update(0, "Test", "Dummy");

        $handler = new UpdateModuleCommandHandler($moduleRepository);
        $handler->handle(new UpdateModuleCommand(0, "Test", "Dummy"));
    }

    public function testItCanDeleteAdminModule()
    {
        $moduleRepository = Mockery::mock(DummyModuleRepository::class);

        $moduleRepository->shouldReceive('delete')->once()->with(0);

        //ModuleService::delete(0);

        $handler = new DeleteModuleCommandHandler($moduleRepository);
        $handler->handle(new DeleteModuleCommand(0));
    }
}
