<?php

namespace Tests\Module\Administration\Role\Infrastructure;

use PHPUnit\Framework\TestCase;
use ProyectoTAU\TAU\Module\Administration\Role\Domain\Role;
use ProyectoTAU\TAU\Module\Administration\Role\Infrastructure\InMemoryRoleRepository;

final class InMemoryRoleTest extends TestCase
{
    public function testItCanCreateRole()
    {
        $roleRepository = new InMemoryRoleRepository();

        $expected = new Role(0, "Test", "Dummy Role");
        $roleRepository->create($expected);

        $actual = $roleRepository->read(0);
        $this->assertEquals($expected, $actual);
    }

    public function testItCanReadRole()
    {
        $roleRepository = new InMemoryRoleRepository();

        $expected = new Role(0, "Test", "Dummy Role");
        $roleRepository->create($expected);

        $actual = $roleRepository->read(0);
        $this->assertEquals($expected, $actual);
    }

    public function testItCanUpdateRole()
    {
        $roleRepository = new InMemoryRoleRepository();

        $expected = new Role(0, "Test", "Dummy Role");
        $roleRepository->create($expected);

        $roleRepository->update(0, "TestOk", "DummyOk");

        $actual = $roleRepository->read(0);

        $this->assertEquals($expected->getName(), $actual->getName());
        $this->assertEquals($expected->getDesc(), $actual->getDesc());
    }

    public function testItCanDeleteRole()
    {
        $roleRepository = new InMemoryRoleRepository();

        $roleRepository->create(new Role(0, "Test", "Dummy Role"));

        $roleRepository->delete(0);

        $this->expectNotice();

        $roleRepository->read(0);
    }
}
