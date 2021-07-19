<?php

namespace ProyectoTAU\TAU\Module\Administration\User\Application\DataTransformer;

use ProyectoTAU\TAU\Module\Administration\User\Domain\User;

class UserArrayDataTransformer implements DataTransformer
{
    /**
     * @var User
     */
    private $user;

    public function write(User $user)
    {
        $this->user = $user;

        return $this;
    }

    public function read()
    {
        return [
            'id'    => $this->user->getId(),
            'name'  => $this->user->getName(),
            'surname' => $this->user->getSurname(),
            'login' => $this->user->getLogin(),
        ];
    }
}
{

}
