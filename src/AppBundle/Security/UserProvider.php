<?php

namespace AppBundle\Security;

use AppBundle\Entity\LCSUser;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;

class UserProvider implements UserProviderInterface
{
    public function loadUserByUsername($username)
    {
        return $this->getUser($username);
    }

    public function refreshUser($user)
    {
        if(!$user instanceof $User)
        {
            throw new UnsupportedUserException(sprintf('Instances of "%s" are not supported.', get_class($user)));
        }

        $username = $user->getUsername();

        return $this->getUser($username);
    }

    public function supportsClass($class)
    {
        return LCSUser::class === $class;
    }

    private function getUser($username)
    {
        $user;
        return null;
    }
}