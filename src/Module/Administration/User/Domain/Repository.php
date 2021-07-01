<?php

namespace TAU\Module\Administration\User\Domain;

interface Repository
{
    public function save();
    public function delete();
}