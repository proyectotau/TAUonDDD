<?php

namespace ProyectoTAU\Tests\Module\Administration\Role\Application;

use Mockery;
use Mockery\Adapter\Phpunit\MockeryTestCase;
use ProyectoTAU\TAU\Module\Administration\Group\Domain\Group;
use ProyectoTAU\TAU\Module\Administration\Module\Domain\Module;
use ProyectoTAU\TAU\Module\Administration\Role\Domain\Role;
use ProyectoTAU\TAU\Module\Administration\Role\Application\readAll\ReadAllRolesCommand;
use ProyectoTAU\TAU\Module\Administration\Role\Application\readAll\ReadAllRolesCommandHandler;
use ProyectoTAU\TAU\Module\Administration\Role\Domain\RoleRepository;
use ProyectoTAU\TAU\Module\Administration\Role\Application\create\CreateRoleCommand;
use ProyectoTAU\TAU\Module\Administration\Role\Application\create\CreateRoleCommandHandler;
use ProyectoTAU\TAU\Module\Administration\Role\Application\read\ReadRoleCommand;
use ProyectoTAU\TAU\Module\Administration\Role\Application\read\ReadRoleCommandHandler;
use ProyectoTAU\TAU\Module\Administration\Role\Application\update\UpdateRoleCommand;
use ProyectoTAU\TAU\Module\Administration\Role\Application\update\UpdateRoleCommandHandler;
use ProyectoTAU\TAU\Module\Administration\Role\Application\delete\DeleteRoleCommand;
use ProyectoTAU\TAU\Module\Administration\Role\Application\delete\DeleteRoleCommandHandler;


class DummyRoleRepository implements RoleRepository {

    public function clear(): void {}

    public function create(Role $role): void
    {
        // Should receive a call once with the same Dummy Role as argument
        if( ! ($role->getId() === 0 &&
            $role->getName() === 'Test' &&
            $role->getDesc() === 'Dummy') )
            throw new \InvalidArgumentException("Mismatched Role received by create method");
    }

    public function read($id): Role
    {
        // Should receive a call with id === 0
        if( ! ($id === 0) ) {
            throw new \InvalidArgumentException("Mismatched Role received by read method");
        }

        return new Role(0, "Test", "Dummy");
    }

    public function readAll(): array
    {
        return [
            new Role(0,null, null),
            new Role(1,null, null)
        ];
    }

    public function update($id, $name, $desc): void
    {
        // Should receive a call once with the same Dummy Role as argument
        if( ! ($id === 0 &&
            $name === 'Test' &&
            $desc === 'Dummy') )
            throw new \InvalidArgumentException("Mismatched Role received by update method");
    }

    public function delete($id): void
    {
        // Should receive a call with id === 0
        if( ! ($id === 0) ) {
            throw new \InvalidArgumentException("Mismatched Role received by delete method");
        }
    }

    public function addGroupToRole(Group $group, Role $role): void {}
    public function removeGroupFromRole(Group $group, Role $role): void {}
    public function addModuleToRole(Module $module, Role $role): void {}
    public function removeModuleFromRole(Module $module, Role $role): void {}
    public function getGroupsFromRole($role):array {return [];}
    public function getModulesFromRole(Role $role): array {return [];}
}

class RoleTest extends MockeryTestCase
{
    public function mockeryTestTearDown()
    {
        Mockery::close();
    }

    public function testItCanCreateAdminRole()
    {
        $roleRepository = Mockery::mock(DummyRoleRepository::class);

        $roleRepository->shouldReceive('create')
            ->once()
            ->with(\Hamcrest\Core\IsEqual::equalTo(
                new Role(0, "Test", "Dummy")));

        //RoleService::create(0, "Test", "Dummy");

        $handler = new CreateRoleCommandHandler($roleRepository);
        $handler->handle(new CreateRoleCommand(0, "Test", "Dummy"));
    }

    public function testItCanReadAdminRole()
    {
        $roleRepository = Mockery::mock(DummyRoleRepository::class);

        $roleRepository->shouldReceive('read')->once()->with(0);

        //RoleService::read(0);

        $handler = new ReadRoleCommandHandler($roleRepository);
        $handler->handle(new ReadRoleCommand(0));
    }

    public function testItCanReadAllAdminRoles()
    {
        $roleRepository = Mockery::mock(DummyRoleRepository::class);

        $roleRepository->shouldReceive('readAll')->once();

        //RoleService::readAll();

        $handler = new ReadAllRolesCommandHandler($roleRepository);
        $handler->handle(new ReadAllRolesCommand());
    }

    public function testItCanUpdateAdminRole()
    {
        $roleRepository = Mockery::mock(DummyRoleRepository::class);

        $roleRepository->shouldReceive('update')->once()->with(0, "Test", "Dummy");

        //RoleService::update(0, "Test", "Dummy");

        $handler = new UpdateRoleCommandHandler($roleRepository);
        $handler->handle(new UpdateRoleCommand(0, "Test", "Dummy"));
    }

    public function testItCanDeleteAdminRole()
    {
        $roleRepository = Mockery::mock(DummyRoleRepository::class);

        $roleRepository->shouldReceive('delete')->once()->with(0);

        //RoleService::delete(0);

        $handler = new DeleteRoleCommandHandler($roleRepository);
        $handler->handle(new DeleteRoleCommand(0));
    }
}
