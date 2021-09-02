<?php

namespace Tests\Module\Administration\Group\Infrastructure;

use PHPUnit\Framework\TestCase;
use ProyectoTAU\TAU\Module\Administration\Group\Domain\Group;
use ProyectoTAU\TAU\Module\Administration\Group\Infrastructure\InMemoryGroupRepository;

final class InMemoryGroupTest extends TestCase
{
    public function testItCanCreateGroup()
    {
        $groupRepository = new InMemoryGroupRepository();

        $expected = new Group(0, "Test", "Dummy Group");
        $groupRepository->create($expected);

        $actual = $groupRepository->read(0);
        $this->assertEquals($expected, $actual);
    }

    public function testItCanReadGroup()
    {
        $groupRepository = new InMemoryGroupRepository();

        $expected = new Group(0, "Test", "Dummy Group");
        $groupRepository->create($expected);

        $actual = $groupRepository->read(0);
        $this->assertEquals($expected, $actual);
    }

    public function testItCanUpdateGroup()
    {
        $groupRepository = new InMemoryGroupRepository();

        $expected = new Group(0, "Test", "Dummy Group");
        $groupRepository->create($expected);

        $groupRepository->update(0, "TestOk", "DummyOk");

        $actual = $groupRepository->read(0);

        $this->assertEquals($expected->getName(), $actual->getName());
        $this->assertEquals($expected->getDesc(), $actual->getDesc());
    }

    public function testItCanDeleteGroup()
    {
        $groupRepository = new InMemoryGroupRepository();

        $groupRepository->create(new Group(0, "Test", "Dummy Group"));

        $groupRepository->delete(0);

        $this->expectException(\InvalidArgumentException::class); // TODO Raise Domain event

        $groupRepository->read(0);
    }
}
