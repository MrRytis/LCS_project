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
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Worker", fetch="EAGER")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="fk_Darbuotojasid", referencedColumnName="id")
     * })
     */
    private $worker;

    /**
     * @var \AppBundle\Entity\UserRole
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\UserRole", fetch="EAGER")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Tipas", referencedColumnName="id")
     * })
     */
    private $type;

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return AccountRequest
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string
     */
    public function getSurname()
    {
        return $this->surname;
    }

    /**
     * @param string $surname
     * @return AccountRequest
     */
    public function setSurname($surname)
    {
        $this->surname = $surname;
        return $this;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param string $email
     * @return AccountRequest
     */
    public function setEmail($email)
    {
        $this->email = $email;
        return $this;
    }

    /**
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param string $password
     * @return AccountRequest
     */
    public function setPassword($password)
    {
        $this->password = $password;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getApplyDate()
    {
        return $this->applyDate;
    }

    /**
     * @param \DateTime $applyDate
     * @return AccountRequest
     */
    public function setApplyDate($applyDate)
    {
        $this->applyDate = $applyDate;
        return $this;
    }

    /**
     * @return bool
     */
    public function isAccepted()
    {
        return $this->accepted;
    }

    /**
     * @param bool $accepted
     * @return AccountRequest
     */
    public function setAccepted($accepted)
    {
        $this->accepted = $accepted;
        return $this;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return AccountRequest
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return \AppBundle\Entity\Worker
     */
    public function getWorker()
    {
        return $this->worker;
    }

    /**
     * @param \AppBundle\Entity\Worker $worker
     * @return AccountRequest
     */
    public function setWorker($worker)
    {
        $this->worker = $worker;
        return $this;
    }

    /**
     * @return \AppBundle\Entity\UserRole
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param \AppBundle\Entity\UserRole $type
     * @return AccountRequest
     */
    public function setType($type)
    {
        $this->type = $type;
        return $this;
    }


}

