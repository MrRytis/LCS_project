<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Produktai
 *
 * @ORM\Table(name="produktai", indexes={@ORM\Index(name="Apibudina", columns={"fk_Medziagu_grupeid"})})
 * @ORM\Entity
 */
class Produktai
{
    /**
     * @return string
     */
    public function getPavadinimas()
    {
        return $this->pavadinimas;
    }

    /**
     * @param string $pavadinimas
     */
    public function setPavadinimas($pavadinimas)
    {
        $this->pavadinimas = $pavadinimas;
    }

    /**
     * @return float
     */
    public function getKaina()
    {
        return $this->kaina;
    }

    /**
     * @param float $kaina
     */
    public function setKaina($kaina)
    {
        $this->kaina = $kaina;
    }

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
     * @return MedziaguGrupes
     */
    public function getFkMedziaguGrupeid()
    {
        return $this->fkMedziaguGrupeid;
    }

    /**
     * @param MedziaguGrupes $fkMedziaguGrupeid
     */
    public function setFkMedziaguGrupeid($fkMedziaguGrupeid)
    {
        $this->fkMedziaguGrupeid = $fkMedziaguGrupeid;
    }
    /**
     * @var string
     *
     * @ORM\Column(name="Pavadinimas", type="string", length=255, nullable=true)
     */
    private $pavadinimas;

    /**
     * @var float
     *
     * @ORM\Column(name="Kaina", type="float", precision=10, scale=0, nullable=true)
     */
    private $kaina;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="Sukurimo_data", type="datetime", nullable=true)
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
     * @var \AppBundle\Entity\MedziaguGrupes
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\MedziaguGrupes", cascade={"persist"})
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="fk_Medziagu_grupeid", referencedColumnName="id")
     * })
     */
    private $fkMedziaguGrupeid;



}

