<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TiekejoProduktai
 *
 * @ORM\Table(name="tiekejo_produktai", indexes={@ORM\Index(name="Itraukta_i", columns={"fk_Produktasid"}), @ORM\Index(name="Tiekia", columns={"fk_Tiekejasid"})})
 * @ORM\Entity
 */
class TiekejoProduktai
{
    /**
     * @return \DateTime
     */
    public function getSukurimoData()
    {
        return $this->sukurimoData;
    }

    /**
     * @param \DateTime $sukurimoData
     */
    public function setSukurimoData($sukurimoData)
    {
        $this->sukurimoData = $sukurimoData;
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
     */
    public function setId($id)
    {
        $this->id = $id;
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
     */
    public function setFkProduktasid($fkProduktasid)
    {
        $this->fkProduktasid = $fkProduktasid;
    }

    /**
     * @return Tiekejai
     */
    public function getFkTiekejasid()
    {
        return $this->fkTiekejasid;
    }

    /**
     * @param Tiekejai $fkTiekejasid
     */
    public function setFkTiekejasid($fkTiekejasid)
    {
        $this->fkTiekejasid = $fkTiekejasid;
    }
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="Sukurimo_data", type="date", nullable=true)
     */
    private $sukurimoData;

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
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Produktai")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="fk_Produktasid", referencedColumnName="id")
     * })
     */
    private $fkProduktasid;

    /**
     * @var \AppBundle\Entity\Tiekejai
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Tiekejai")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="fk_Tiekejasid", referencedColumnName="id")
     * })
     */
    private $fkTiekejasid;


}

