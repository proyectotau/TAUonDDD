<?php

namespace ProyectoTAU\TAU\Module\Administration\User\Domain;

interface Repository
{
    public function save(): void;
    public function delete(): void;
}