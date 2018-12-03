<?php

namespace AppBundle\Entity;

use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\EquatableInterface;
use Doctrine\ORM\Mapping as ORM;
use AppBundle\Entity\UserRole;
use AppBundle\Entity\AccountRequest;

/**
 * Paskyros
 *
 * @ORM\Table(name="paskyros", uniqueConstraints={@ORM\UniqueConstraint(name="fk_Paskyros_prasymasid", columns={"fk_Paskyros_prasymasid"})}, indexes={@ORM\Index(name="Tipas", columns={"Tipas"})})
 * @ORM\Entity
 */
class LcsUser implements UserInterface, EquatableInterface
{
    /**
     * @var string
     *
     * @ORM\Column(name="Vardas", type="string", length=255, nullable=false)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="Pavarde", type="string", length=255, nullable=false)
     */
    private $surname;

    /**
     * @var string
     *
     * @ORM\Column(name="E_pastas", type="string", length=255, nullable=false)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="Slaptazodis", type="string", length=255, nullable=false)
     */
    private $password;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="Registracijos_data", type="date", nullable=false)
     */
    private $registration;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="Paskutinio_prisijungimo_data", type="date", nullable=true)
     */
    private $lastLogin;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var \AppBundle\Entity\AccountRequest
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\AccountRequest")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="fk_Paskyros_prasymasid", referencedColumnName="id")
     * })
     */
    private $accountRequest;

    /**
     * @var \AppBundle\Entity\UserRole
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\UserRole")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Tipas", referencedColumnName="id")
     * })
     */
    private $type;

    public function setName($value)
    {
        $this->name = $value;
    }

    public function getName()
    {
        return $this->name;
    }
 
    public function setSurname($value)
    {
        $this->surname = $value;
    }

    public function getSurname()
    {
        return $this->surname;
    }

    public function setEmail($value)
    {
        $this->email = $value;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setPassword($value)
    {
        $this->password = $value;
    }

    public function setRegistration($value)
    {
        $this->registration = $value;
    }

    public function getRegistration()
    {
        return $this->registration;
    }

    public function setLastLogin($value)
    {
        $this->lastLogin = $value;
    }

    public function getlastLogin()
    {
        return $this->lastLogin;
    }

    public function setId($value)
    {
        $this->id = $value;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setAccountRequest($value)
    {
        $this->accountRequest = $value;
    }

    public function getAccountRequest()
    {
        return $this->accountRequest;
    }

    public function setType($value)
    {
        $this->type = $value;
    }

    public function getType()
    {
        return $this->type;
    }

    public function getRoles()
    {
        $role = $this->type->getName();
        return array($role);
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
    {/* no salt */}

    public function eraseCredentials()
    { /* unused */}

    public function isEqualTo($user)
    {
        if(!$user instanceof LCSUser)
        {
            return false;
        }

        return ($this->getPassword() === $user->getPassword()) && ($this->getUsername() === $user->getUsername());
    }
}

