<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use AppBundle\Entity\Client;

/**
 * Atsiskaitymai
 *
 * @ORM\Table(name="atsiskaitymai", uniqueConstraints={@ORM\UniqueConstraint(name="fk_Uzsakymasid", columns={"fk_Uzsakymasid"}), @ORM\UniqueConstraint(name="fk_Klientasid", columns={"fk_Klientasid"})})
 * @ORM\Entity
 */
class Atsiskaitymai
{
    /**
     * @var float
     *
     * @ORM\Column(name="Suma", type="float", precision=10, scale=0, nullable=true)
     */
    private $suma;

    /**
     * @var string
     *
     * @ORM\Column(name="Korteles_nr", type="string", length=255, nullable=true)
     */
    private $kortelesNr;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="Data", type="date", nullable=true)
     */
    private $data;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var \AppBundle\Entity\Uzsakymai
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Uzsakymai")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="fk_Uzsakymasid", referencedColumnName="id")
     * })
     */
    private $fkUzsakymasid;

    /**
     * @var \AppBundle\Entity\Client
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Client")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="fk_Klientasid", referencedColumnName="id")
     * })
     */
    private $fkKlientasid;

    /**
     * @return float
     */
    public function getSuma()
    {
        return $this->suma;
    }

    /**
     * @param float $suma
     * @return Atsiskaitymai
     */
    public function setSuma($suma)
    {
        $this->suma = $suma;
        return $this;
    }

    /**
     * @return string
     */
    public function getKortelesNr()
    {
        return $this->kortelesNr;
    }

    /**
     * @param string $kortelesNr
     * @return Atsiskaitymai
     */
    public function setKortelesNr($kortelesNr)
    {
        $this->kortelesNr = $kortelesNr;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * @param \DateTime $data
     * @return Atsiskaitymai
     */
    public function setData($data)
    {
        $this->data = $data;
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
     * @return Atsiskaitymai
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return Uzsakymai
     */
    public function getFkUzsakymasid()
    {
        return $this->fkUzsakymasid;
    }

    /**
     * @param Uzsakymai $fkUzsakymasid
     * @return Atsiskaitymai
     */
    public function setFkUzsakymasid($fkUzsakymasid)
    {
        $this->fkUzsakymasid = $fkUzsakymasid;
        return $this;
    }

    /**
     * @return Client
     */
    public function getFkKlientasid()
    {
        return $this->fkKlientasid;
    }

    /**
     * @param Client $fkKlientasid
     * @return Atsiskaitymai
     */
    public function setFkKlientasid($fkKlientasid)
    {
        $this->fkKlientasid = $fkKlientasid;
        return $this;
    }
}

