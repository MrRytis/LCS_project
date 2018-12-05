<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Tiekejai
 *
 * @ORM\Table(name="tiekejai")
 * @ORM\Entity
 */
class Tiekejai
{
    /**
     * @return string
     */
    public function getVardas()
    {
        return $this->vardas;
    }

    /**
     * @param string $vardas
     */
    public function setVardas($vardas)
    {
        $this->vardas = $vardas;
    }

    /**
     * @return string
     */
    public function getFirmosPav()
    {
        return $this->firmosPav;
    }

    /**
     * @param string $firmosPav
     */
    public function setFirmosPav($firmosPav)
    {
        $this->firmosPav = $firmosPav;
    }

    /**
     * @return string
     */
    public function getEPastas()
    {
        return $this->ePastas;
    }

    /**
     * @param string $ePastas
     */
    public function setEPastas($ePastas)
    {
        $this->ePastas = $ePastas;
    }

    /**
     * @return string
     */
    public function getVadybininkas()
    {
        return $this->vadybininkas;
    }

    /**
     * @param string $vadybininkas
     */
    public function setVadybininkas($vadybininkas)
    {
        $this->vadybininkas = $vadybininkas;
    }

    /**
     * @return int
     */
    public function getFakturosNr()
    {
        return $this->fakturosNr;
    }

    /**
     * @param int $fakturosNr
     */
    public function setFakturosNr($fakturosNr)
    {
        $this->fakturosNr = $fakturosNr;
    }

    /**
     * @return string
     */
    public function getVadybininkoEPastas()
    {
        return $this->vadybininkoEPastas;
    }

    /**
     * @param string $vadybininkoEPastas
     */
    public function setVadybininkoEPastas($vadybininkoEPastas)
    {
        $this->vadybininkoEPastas = $vadybininkoEPastas;
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
     * @var string
     *
     * @ORM\Column(name="Vardas", type="string", length=255, nullable=true)
     */
    private $vardas;

    /**
     * @var string
     *
     * @ORM\Column(name="Firmos_pav", type="string", length=255, nullable=true)
     */
    private $firmosPav;

    /**
     * @var string
     *
     * @ORM\Column(name="E_pastas", type="string", length=255, nullable=true)
     */
    private $ePastas;

    /**
     * @var string
     *
     * @ORM\Column(name="Vadybininkas", type="string", length=255, nullable=true)
     */
    private $vadybininkas;

    /**
     * @var integer
     *
     * @ORM\Column(name="Fakturos_Nr", type="integer", nullable=true)
     */
    private $fakturosNr;

    /**
     * @var string
     *
     * @ORM\Column(name="Vadybininko_e_pastas", type="string", length=255, nullable=true)
     */
    private $vadybininkoEPastas;

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


}

