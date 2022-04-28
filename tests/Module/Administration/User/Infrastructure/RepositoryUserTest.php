<?php

namespace ProyectoTAU\Tests\Module\Administration\User\Infrastructure;

use PHPUnit\Framework\TestCase;
use ProyectoTAU\TAU\Module\Administration\User\Domain\User;

final class RepositoryUserTest extends TestCase
{
    public function testItCanCreateUser()
    {
        $userRepository = app()->get('ProyectoTAU\TAU\Module\Administration\User\Domain\UserRepository');
        $userRepository->clear();

        $expected = new User(0, "Test", "Dummy", "fakelogin");
        $userRepository->create($expected);

        $actual = $userRepository->read(0);
        $this->assertEquals($expected, $actual);
    }

    public function testItCanReadUser()
    {
        $userRepository = app()->get('ProyectoTAU\TAU\Module\Administration\User\Domain\UserRepository');
        $userRepository->clear();

        $expected = new User(0, "Test", "Dummy", "fakelogin");
        $userRepository->create($expected);

        $actual = $userRepository->read(0);
        $this->assertEquals($expected, $actual);
    }

    public function testItCanUpdateUser()
    {
        $userRepository = app()->get('ProyectoTAU\TAU\Module\Administration\User\Domain\UserRepository');
        $userRepository->clear();

        $userRepository->create(new User(0, "Test", "Dummy", "fakelogin"));

        $userRepository->update(0, "TestOk", "DummyOk", "fakeloginOk");
        $expected = new User(0, "TestOk", "DummyOk", "fakeloginOk");

        $actual = $userRepository->read(0);

        $this->assertEquals($expected->getName(), $actual->getName());
        $this->assertEquals($expected->getSurname(), $actual->getSurname());
        $this->assertEquals($expected->getLogin(), $actual->getLogin());
    }

    public function testItCanDeleteUser()
    {
        $userRepository = app()->get('ProyectoTAU\TAU\Module\Administration\User\Domain\UserRepository');
        $userRepository->clear();

        $userRepository->create(new User(0, "Test", "Dummy", "fakelogin"));

        $userRepository->delete(0);

        $this->expectException(\InvalidArgumentException::class); // TODO Raise Domain event

        $userRepository->read(0);
    }
}
