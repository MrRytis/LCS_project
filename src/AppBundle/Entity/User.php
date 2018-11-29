<?php

namespace AppBundle\Entity;

use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\EquatableInterface;

class LCSUser implements UserInterface, EquatableInterface
{
    private $email;
    private $password;
    private $role;

    public function __construct($email, $password, $salt, $roles)
    {
        $this->email = $email;
        $this->password = $password;
        $this->role = $roles[0];
    }

    public function getRoles()
    {
        return array($this->role);
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function getUsername()
    {
        return $this->email;
    }

    public function getSalt()
    {
        // no salt
    }

    public function eraseCredentials()
    {
        //
    }

    public function isEqualTo($user)
    {
        if(!user instanceof LCSUser)
        {
            return false;
        }

        return ($this->password === $user->getPassword()) && ($this->email === $user->getUsername());
    }
}