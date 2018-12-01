<?php

namespace AppBundle\Entity;

use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\EquatableInterface;
use Doctrine\ORM\Mapping as ORM;

/**
 * Paskyros
 *
 * @ORM\Table(name="paskyros", uniqueConstraints={@ORM\UniqueConstraint(name="fk_Paskyros_prasymasid", columns={"fk_Paskyros_prasymasid"})}, indexes={@ORM\Index(name="Tipas", columns={"Tipas"})})
 * @ORM\Entity
 */
class LCSUser implements UserInterface, EquatableInterface
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
    private $registrationDate;

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
     * @var \AppBundle\Entity\PaskyruPrasymai
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\PaskyruPrasymai")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="fk_Paskyros_prasymasid", referencedColumnName="id")
     * })
     */
    private $accountRequest;

    /**
     * @var \AppBundle\Entity\VartotojuRoles
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\VartotojuRoles")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Tipas", referencedColumnName="id")
     * })
     */
    private $role;

    public function __construct()
    {
        //
    }

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

