<?php

namespace Tests\Module\Administration\Module\Infrastructure;

use PHPUnit\Framework\TestCase;
use ProyectoTAU\TAU\Module\Administration\Module\Domain\Module;
use ProyectoTAU\TAU\Module\Administration\Module\Infrastructure\InMemoryModuleRepository;

final class InMemoryModuleTest extends TestCase
{
    public function testItCanCreateModule()
    {
        $moduleRepository = new InMemoryModuleRepository();

        $expected = new Module(0, "Test", "Dummy Module");
        $moduleRepository->create($expected);

        $actual = $moduleRepository->read(0);
        $this->assertEquals($expected, $actual);
    }

    public function testItCanReadModule()
    {
        $moduleRepository = new InMemoryModuleRepository();

        $expected = new Module(0, "Test", "Dummy Module");
        $moduleRepository->create($expected);

        $actual = $moduleRepository->read(0);
        $this->assertEquals($expected, $actual);
    }

    public function testItCanUpdateModule()
    {
        $moduleRepository = new InMemoryModuleRepository();

        $expected = new Module(0, "Test", "Dummy Module");
        $moduleRepository->create($expected);

        $moduleRepository->update(0, "TestOk", "DummyOk");

        $actual = $moduleRepository->read(0);

        $this->assertEquals($expected->getName(), $actual->getName());
        $this->assertEquals($expected->getDesc(), $actual->getDesc());
    }

    public function testItCanDeleteModule()
    {
        $moduleRepository = new InMemoryModuleRepository();

        $moduleRepository->create(new Module(0, "Test", "Dummy Module"));

        $moduleRepository->delete(0);

        $this->expectNotice();

        $moduleRepository->read(0);
    }
}
