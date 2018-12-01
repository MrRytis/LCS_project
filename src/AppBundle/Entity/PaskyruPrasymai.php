<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

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
     * @ORM\Column(name="Vardas", type="string", length=255, nullable=true)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="Pavarde", type="string", length=255, nullable=true)
     */
    private $surname;

    /**
     * @var string
     *
     * @ORM\Column(name="E_pastas", type="string", length=255, nullable=true)
     */
    private $email;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="Uzpildymo_data", type="date", nullable=true)
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
     * @var \AppBundle\Entity\Darbuotojai
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Darbuotojai")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="fk_Darbuotojasid", referencedColumnName="id")
     * })
     */
    private $worker;

    /**
     * @var \AppBundle\Entity\VartotojuRoles
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\VartotojuRoles")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Tipas", referencedColumnName="id")
     * })
     */
    private $type;

    public function SetName($value)
    {
        $this->name = $value;
    }

    public function SetSurname($value)
    {
        $this->surname = $value;
    }

    public function SetEmail($value)
    {
        $this->email = $value;
    }

    public function SetPassword($value)
    {
        $this->password = $value;
    }

    public function SetType($value)
    {
        $this->type = $value;
    }

    public function SetApplyDate($value)
    {
        $this->applyDate = $value;
    }

    public function SetAccepted($value)
    {
        $this->accepted = $value;
    }

    public function SetWorker($value)
    {
        $this->worker = $value;
    }
}

