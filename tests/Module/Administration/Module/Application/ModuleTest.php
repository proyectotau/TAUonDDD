<?php

namespace Tests\Module\Administration\Module\Application;

use Mockery;
use PHPUnit\Framework\TestCase;
use ProyectoTAU\TAU\Common\InMemoryRepository;
use ProyectoTAU\TAU\Module\Administration\Group\Domain\Group;
use ProyectoTAU\TAU\Module\Administration\Module\Domain\Module;
use ProyectoTAU\TAU\Module\Administration\Module\Domain\ModuleRepository;
use ProyectoTAU\TAU\Module\Administration\Module\Application\create\CreateModule;
use ProyectoTAU\TAU\Module\Administration\Module\Application\read\ReadModule;
use ProyectoTAU\TAU\Module\Administration\Module\Application\update\UpdateModule;
use ProyectoTAU\TAU\Module\Administration\Module\Application\delete\DeleteModule;
use ProyectoTAU\TAU\Module\Administration\Role\Domain\Role;

class DummyModuleRepository implements ModuleRepository {

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

    public function addRoleToModule(Role $role, Module $module){}
    public function getRolesFromModule(Module $module): array {return [];}
}

class ModuleTest extends TestCase
{
    public function mockeryTestTearDown()
    {
        Mockery::close();
    }

    public function testItCanCreateAdminModule()
    {
        InMemoryRepository::getInstance()->clear();

        $moduleRepository = Mockery::mock(DummyModuleRepository::class);

        $moduleRepository->shouldReceive('create')
            ->once()
            ->with(\Hamcrest\Core\IsEqual::equalTo(
                new Module(0, "Test", "Dummy")));

        $module = new CreateModule($moduleRepository);
        $module->create(0, "Test", "Dummy");
    }

    public function testItCanReadAdminModule()
    {
        InMemoryRepository::getInstance()->clear();

        $moduleRepository = Mockery::mock(DummyModuleRepository::class);

        $moduleRepository->shouldReceive('read')->once()->with(0);

        $module = new ReadModule($moduleRepository);
        $module->read(0);
    }

    public function testItCanUpdateAdminModule()
    {
        InMemoryRepository::getInstance()->clear();

        $moduleRepository = Mockery::mock(DummyModuleRepository::class);

        $moduleRepository->shouldReceive('update')->once()->with(0, "Test", "Dummy");

        $module = new UpdateModule($moduleRepository);
        $module->update(0, "Test", "Dummy");
    }

    public function testItCanDeleteAdminModule()
    {
        InMemoryRepository::getInstance()->clear();

        $moduleRepository = Mockery::mock(DummyModuleRepository::class);

        $moduleRepository->shouldReceive('delete')->once()->with(0);

        $module = new DeleteModule($moduleRepository);
        $module->delete(0);
    }
}
