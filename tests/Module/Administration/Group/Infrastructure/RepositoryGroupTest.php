<?php

namespace ProyectoTAU\Tests\Module\Administration\Group\Infrastructure;

use PHPUnit\Framework\TestCase;
use ProyectoTAU\TAU\Module\Administration\Group\Domain\Group;
use ProyectoTAU\TAU\Module\Administration\User\Domain\User;

final class RepositoryGroupTest extends TestCase
{
    public function testItCanCreateGroup()
    {
        $groupRepository = app()->get('ProyectoTAU\TAU\Module\Administration\Group\Domain\GroupRepository');
        $groupRepository->clear();

        $expected = new Group(0, "Test", "Dummy Group");
        $groupRepository->create($expected);

        $actual = $groupRepository->read(0);
        $this->assertEquals($expected, $actual);
    }

    public function testItCanReadGroup()
    {
        $groupRepository = app()->get('ProyectoTAU\TAU\Module\Administration\Group\Domain\GroupRepository');
        $groupRepository->clear();

        $expected = new Group(0, "Test", "Dummy Group");
        $groupRepository->create($expected);

        $actual = $groupRepository->read(0);
        $this->assertEquals($expected, $actual);
    }

    public function testItCanReadAllGroups()
    {
        $groupRepository = app()->get('ProyectoTAU\TAU\Module\Administration\Group\Domain\GroupRepository');
        $groupRepository->clear();

        $grp1 = new Group(1, "Test1", "Dummy Group1");
        $grp2 = new Group(2, "Test2", "Dummy Group2");
        $groupRepository->create($grp1);
        $groupRepository->create($grp2);

        $expected = [
            $grp1,
            $grp2
        ];

        $actual = $groupRepository->readAll();
        $this->assertEqualsCanonicalizing($expected, $actual);
    }

    public function testItCanUpdateGroup()
    {
        $groupRepository = app()->get('ProyectoTAU\TAU\Module\Administration\Group\Domain\GroupRepository');
        $groupRepository->clear();

        $groupRepository->create(new Group(0, "Test", "Dummy Group"));

        $groupRepository->update(0, "TestOk", "DummyOk");
        $expected = new Group(0, "TestOk", "DummyOk");

        $actual = $groupRepository->read(0);

        $this->assertEquals($expected->getName(), $actual->getName());
        $this->assertEquals($expected->getDesc(), $actual->getDesc());
    }

    public function testItCanDeleteGroup()
    {
        $groupRepository = app()->get('ProyectoTAU\TAU\Module\Administration\Group\Domain\GroupRepository');
        $groupRepository->clear();

        $groupRepository->create(new Group(0, "Test", "Dummy Group"));

        $groupRepository->delete(0);

        $this->expectException(\InvalidArgumentException::class); // TODO Raise Domain event

        $groupRepository->read(0);
    }
}
