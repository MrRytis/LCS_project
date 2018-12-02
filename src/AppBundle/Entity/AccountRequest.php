<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use AppBundle\Entity\UserRole;
use AppBundle\Entity\Worker;

/**
 * PaskyruPrasymai
 *
 * @ORM\Table(name="paskyru_prasymai", indexes={@ORM\Index(name="Tipas", columns={"Tipas"}), @ORM\Index(name="Patvirtina", columns={"fk_Darbuotojasid"})})
 * @ORM\Entity
 */
class AccountRequest
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
     * @ORM\Column(name="Uzpildymo_data", type="date", nullable=false)
     */
    private $applyDate;

    /**
     * @var boolean
     *
     * @ORM\Column(name="Patvirtinta", type="boolean", nullable=true)
     */
    private $accepted;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var \AppBundle\Entity\Worker
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Darbuotojai")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="fk_Darbuotojasid", referencedColumnName="id")
     * })
     */
    private $worker;

    /**
     * @var \AppBundle\Entity\UserRole
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\VartotojuRoles")
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

    public function getPassword()
    {
        return $this->password;
    }

    public function setApplyDate($value)
    {
        $this->applyDate = $value;
    }

    public function getApplyDate()
    {
        return $this->applyDate;
    }

    public function setId($value)
    {
        $this->id = $value;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setWorker($value)
    {
        $this->worker = $value;
    }

    public function getWorker()
    {
        return $this->worker;
    }

    public function setType($value)
    {
        $this->type = $value;
    }

    public function getType()
    {
        return $this->type;
    }
}

