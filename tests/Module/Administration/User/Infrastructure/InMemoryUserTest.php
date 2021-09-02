<?php

namespace Tests\Module\Administration\User\Infrastructure;

use PHPUnit\Framework\TestCase;
use ProyectoTAU\TAU\Module\Administration\User\Domain\User;
use ProyectoTAU\TAU\Module\Administration\User\Infrastructure\InMemoryUserRepository;

final class InMemoryUserTest extends TestCase
{
    public function testItCanCreateUser()
    {
        $userRepository = new InMemoryUserRepository();

        $expected = new User(0, "Test", "Dummy", "fakelogin");
        $userRepository->create($expected);

        $actual = $userRepository->read(0);
        $this->assertEquals($expected, $actual);
    }

    public function testItCanReadUser()
    {
        $userRepository = new InMemoryUserRepository();

        $expected = new User(0, "Test", "Dummy", "fakelogin");
        $userRepository->create($expected);

        $actual = $userRepository->read(0);
        $this->assertEquals($expected, $actual);
    }

    public function testItCanUpdateUser()
    {
        $userRepository = new InMemoryUserRepository();

        $expected = new User(0, "Test", "Dummy", "fakelogin");
        $userRepository->create($expected);

        $userRepository->update(0, "TestOk", "DummyOk", "fakeloginOk");

        $actual = $userRepository->read(0);

        $this->assertEquals($expected->getName(), $actual->getName());
        $this->assertEquals($expected->getSurname(), $actual->getSurname());
        $this->assertEquals($expected->getLogin(), $actual->getLogin());
    }

    public function testItCanDeleteUser()
    {
        $userRepository = new InMemoryUserRepository();

        $userRepository->create(new User(0, "Test", "Dummy", "fakelogin"));

        $userRepository->delete(0);

        $this->expectException(\InvalidArgumentException::class); // TODO Raise Domain event

        $userRepository->read(0);
    }
}
