<?php

namespace ProyectoTAU\Tests\Module\Administration\Role\Infrastructure;

use PHPUnit\Framework\TestCase;
use ProyectoTAU\TAU\Module\Administration\Role\Domain\Role;

final class RepositoryRoleTest extends TestCase
{
    public function testItCanCreateRole()
    {
        $roleRepository = app()->get('ProyectoTAU\TAU\Module\Administration\Role\Domain\RoleRepository');
        $roleRepository->clear();

        $expected = new Role(0, "Test", "Dummy Role");
        $roleRepository->create($expected);

        $actual = $roleRepository->read(0);
        $this->assertEquals($expected, $actual);
    }

    public function testItCanReadRole()
    {
        $roleRepository = app()->get('ProyectoTAU\TAU\Module\Administration\Role\Domain\RoleRepository');
        $roleRepository->clear();

        $expected = new Role(0, "Test", "Dummy Role");
        $roleRepository->create($expected);

        $actual = $roleRepository->read(0);
        $this->assertEquals($expected, $actual);
    }

    public function testItCanUpdateRole()
    {
        $roleRepository = app()->get('ProyectoTAU\TAU\Module\Administration\Role\Domain\RoleRepository');
        $roleRepository->clear();

        $roleRepository->create(new Role(0, "Test", "Dummy Role"));

        $roleRepository->update(0, "TestOk", "DummyOk");
        $expected = new Role(0, "TestOk", "DummyOk");

        $actual = $roleRepository->read(0);

        $this->assertEquals($expected->getName(), $actual->getName());
        $this->assertEquals($expected->getDesc(), $actual->getDesc());
    }

    public function testItCanDeleteRole()
    {
        $roleRepository = app()->get('ProyectoTAU\TAU\Module\Administration\Role\Domain\RoleRepository');
        $roleRepository->clear();

        $roleRepository->create(new Role(0, "Test", "Dummy Role"));

        $roleRepository->delete(0);

        $this->expectException(\InvalidArgumentException::class); // TODO Raise Domain event

        $roleRepository->read(0);
    }
}
