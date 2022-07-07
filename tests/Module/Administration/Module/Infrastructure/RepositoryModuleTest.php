<?php

namespace ProyectoTAU\Tests\Module\Administration\Module\Infrastructure;

use PHPUnit\Framework\TestCase;
use ProyectoTAU\TAU\Module\Administration\Group\Domain\Group;
use ProyectoTAU\TAU\Module\Administration\Module\Domain\Module;

final class RepositoryModuleTest extends TestCase
{
    public function testItCanCreateModule()
    {
        $moduleRepository = app()->get('ProyectoTAU\TAU\Module\Administration\Module\Domain\ModuleRepository');
        $moduleRepository->clear();

        $expected = new Module(0, "Test", "Dummy Module");
        $moduleRepository->create($expected);

        $actual = $moduleRepository->read(0);
        $this->assertEquals($expected, $actual);
    }

    public function testItCanReadModule()
    {
        $moduleRepository = app()->get('ProyectoTAU\TAU\Module\Administration\Module\Domain\ModuleRepository');
        $moduleRepository->clear();

        $expected = new Module(0, "Test", "Dummy Module");
        $moduleRepository->create($expected);

        $actual = $moduleRepository->read(0);
        $this->assertEquals($expected, $actual);
    }

    public function testItCanReadAllModules()
    {
        $moduleRepository = app()->get('ProyectoTAU\TAU\Module\Administration\Module\Domain\ModuleRepository');
        $moduleRepository->clear();

        $mod1 = new Module(1, "Test1", "Dummy Module1");
        $mod2 = new Module(2, "Test2", "Dummy Module2");
        $moduleRepository->create($mod1);
        $moduleRepository->create($mod2);

        $expected = [
            $mod1,
            $mod2
        ];

        $actual = $moduleRepository->readAll();
        $this->assertEqualsCanonicalizing($expected, $actual);
    }

    public function testItCanUpdateModule()
    {
        $moduleRepository = app()->get('ProyectoTAU\TAU\Module\Administration\Module\Domain\ModuleRepository');
        $moduleRepository->clear();

        $moduleRepository->create(new Module(0, "Test", "Dummy Module"));

        $moduleRepository->update(0, "TestOk", "DummyOk");
        $expected = new Module(0, "TestOk", "DummyOk");

        $actual = $moduleRepository->read(0);

        $this->assertEquals($expected->getName(), $actual->getName());
        $this->assertEquals($expected->getDesc(), $actual->getDesc());
    }

    public function testItCanDeleteModule()
    {
        $moduleRepository = app()->get('ProyectoTAU\TAU\Module\Administration\Module\Domain\ModuleRepository');
        $moduleRepository->clear();

        $moduleRepository->create(new Module(0, "Test", "Dummy Module"));

        $moduleRepository->delete(0);

        $this->expectException(\InvalidArgumentException::class); // TODO Raise Domain event

        $moduleRepository->read(0);
    }
}
