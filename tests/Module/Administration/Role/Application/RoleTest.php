<?php

namespace Tests\Module\Administration\Role\Application;

use Mockery;
use PHPUnit\Framework\TestCase;
use ProyectoTAU\TAU\Common\InMemoryRepository;
use ProyectoTAU\TAU\Module\Administration\Group\Domain\Group;
use ProyectoTAU\TAU\Module\Administration\Module\Domain\Module;
use ProyectoTAU\TAU\Module\Administration\Role\Domain\Role;
use ProyectoTAU\TAU\Module\Administration\Role\Domain\RoleRepository;
use ProyectoTAU\TAU\Module\Administration\Role\Application\create\CreateRole;
use ProyectoTAU\TAU\Module\Administration\Role\Application\read\ReadRole;
use ProyectoTAU\TAU\Module\Administration\Role\Application\update\UpdateRole;
use ProyectoTAU\TAU\Module\Administration\Role\Application\delete\DeleteRole;

class DummyRoleRepository implements RoleRepository {

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
    public function addModuleToRole(Module $module, Role $role): void {}
    public function getGroupsFromRole($role):array {return [];}
    public function getModulesFromRole(Role $role): array {return [];}
}

class RoleTest extends TestCase
{
    public function mockeryTestTearDown()
    {
        Mockery::close();
    }

    public function testItCanCreateAdminRole()
    {
        InMemoryRepository::getInstance()->clear();

        $groupRepository = Mockery::mock(DummyRoleRepository::class);

        $groupRepository->shouldReceive('create')
            ->once()
            ->with(\Hamcrest\Core\IsEqual::equalTo(
                new Role(0, "Test", "Dummy")));

        $group = new CreateRole($groupRepository);
        $group->create(0, "Test", "Dummy");
    }

    public function testItCanReadAdminRole()
    {
        InMemoryRepository::getInstance()->clear();

        $groupRepository = Mockery::mock(DummyRoleRepository::class);

        $groupRepository->shouldReceive('read')->once()->with(0);

        $group = new ReadRole($groupRepository);
        $group->read(0);
    }

    public function testItCanUpdateAdminRole()
    {
        InMemoryRepository::getInstance()->clear();

        $groupRepository = Mockery::mock(DummyRoleRepository::class);

        $groupRepository->shouldReceive('update')->once()->with(0, "Test", "Dummy");

        $group = new UpdateRole($groupRepository);
        $group->update(0, "Test", "Dummy");
    }

    public function testItCanDeleteAdminRole()
    {
        InMemoryRepository::getInstance()->clear();

        $groupRepository = Mockery::mock(DummyRoleRepository::class);

        $groupRepository->shouldReceive('delete')->once()->with(0);

        $group = new DeleteRole($groupRepository);
        $group->delete(0);
    }
}
