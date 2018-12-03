<?php

namespace AppBundle\Security;

use AppBundle\Entity\LCSUser;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\NoResultException;

class UserProvider extends EntityRepository implements UserProviderInterface
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
        $q = $this
            ->createQueryBuilder('u')
            ->where('u.E_pastas = :email')
            ->setParameter('email', $username)
            ->getQuery();

        try {
            // The Query::getSingleResult() method throws an exception
            // if there is no record matching the criteria.
            $user = $q->getSingleResult();
        } catch (NoResultException $e) {
            $message = sprintf(
                'Nerastas vartotojas, kurio prisijungimo vardas yra "%s".',
                $username
            );
            throw new UsernameNotFoundException($message, null, 0, $e);
        }

        return $user;
    }
}