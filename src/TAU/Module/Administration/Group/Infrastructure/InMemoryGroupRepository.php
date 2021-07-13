<?php

namespace ProyectoTAU\TAU\Module\Administration\Group\Infrastructure;

use ProyectoTAU\TAU\Module\Administration\Group\Domain\Group;
use ProyectoTAU\TAU\Module\Administration\Group\Domain\GroupRepository;

class InMemoryGroupRepository implements GroupRepository
{
    private $groupDataStore = [];

    public function create(Group $group): void
    {
        $this->groupDataStore[$group->getId()] = $group;
    }

    public function read($id): Group
    {
        return $this->groupDataStore[$id];
    }

    public function update($id, $name, $desc): void
    {
        $this->groupDataStore[$id]->setName($name);
        $this->groupDataStore[$id]->setName($desc);
    }

    public function delete($id): void
    {
        unset($this->groupDataStore[$id]);
    }
}
