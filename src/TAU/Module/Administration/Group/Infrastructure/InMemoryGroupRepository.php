<?php

namespace ProyectoTAU\TAU\Module\Administration\Group\Infrastructure;

use ProyectoTAU\TAU\Common\InMemoryRepository;
use ProyectoTAU\TAU\Module\Administration\Group\Domain\Group;
use ProyectoTAU\TAU\Module\Administration\Group\Domain\GroupRepository;

class InMemoryGroupRepository implements GroupRepository
{
    public function create(Group $group): void
    {
        InMemoryRepository::getInstance()->createGroup($group);
    }

    public function read($id): Group
    {
        return InMemoryRepository::getInstance()->readGroup($id);
    }

    public function update($id, $name, $desc): void
    {
        InMemoryRepository::getInstance()->updateGroup($id, $name, $desc);
    }

    public function delete($id): void
    {
        InMemoryRepository::getInstance()->deleteGroup($id);
    }
}