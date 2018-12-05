<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Kiekiai
 *
 * @ORM\Table(name="kiekiai", uniqueConstraints={@ORM\UniqueConstraint(name="fk_Uzsakymasid1", columns={"fk_Uzsakymasid1"})}, indexes={@ORM\Index(name="Turi_tiek", columns={"fk_Uzsakymasid"}), @ORM\Index(name="Turi6", columns={"fk_Produktasid"})})
 * @ORM\Entity
 */
class Kiekiai
{
    /**
     * @var integer
     *
     * @ORM\Column(name="Kiekis", type="integer", nullable=true)
     */
    private $kiekis;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var \AppBundle\Entity\Produktai
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Produktai", cascade={"persist"})
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="fk_Produktasid", referencedColumnName="id")
     * })
     */
    private $fkProduktasid;

    /**
     * @var \AppBundle\Entity\Uzsakymai
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Uzsakymai", cascade={"persist"})
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="fk_Uzsakymasid", referencedColumnName="id")
     * })
     */
    private $fkUzsakymasid;

    /**
     * @var \AppBundle\Entity\Uzsakymai
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Uzsakymai")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="fk_Uzsakymasid1", referencedColumnName="id")
     * })
     */
    private $fkUzsakymasid1;

    /**
     * @return int
     */
    public function getKiekis()
    {
        return $this->kiekis;
    }

    /**
     * @param int $kiekis
     * @return Kiekiai
     */
    public function setKiekis($kiekis)
    {
        $this->kiekis = $kiekis;
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
     * @return Kiekiai
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return Produktai
     */
    public function getFkProduktasid()
    {
        return $this->fkProduktasid;
    }

    /**
     * @param Produktai $fkProduktasid
     * @return Kiekiai
     */
    public function setFkProduktasid($fkProduktasid)
    {
        $this->fkProduktasid = $fkProduktasid;
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
     * @return Kiekiai
     */
    public function setFkUzsakymasid($fkUzsakymasid)
    {
        $this->fkUzsakymasid = $fkUzsakymasid;
        return $this;
    }

    /**
     * @return Uzsakymai
     */
    public function getFkUzsakymasid1()
    {
        return $this->fkUzsakymasid1;
    }

    /**
     * @param Uzsakymai $fkUzsakymasid1
     * @return Kiekiai
     */
    public function setFkUzsakymasid1($fkUzsakymasid1)
    {
        $this->fkUzsakymasid1 = $fkUzsakymasid1;
        return $this;
    }
}

