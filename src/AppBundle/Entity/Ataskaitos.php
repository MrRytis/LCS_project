<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Ataskaitos
 *
 * @ORM\Table(name="ataskaitos", indexes={@ORM\Index(name="Tipas", columns={"Tipas"})})
 * @ORM\Entity
 */
class Ataskaitos
{
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="Nuo_kada", type="date", nullable=true)
     */
    private $nuoKada;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="Iki_kada", type="date", nullable=true)
     */
    private $ikiKada;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="Sukurimo_data", type="date", nullable=true)
     */
    private $sukurimoData;

    /**
     * @var integer
     *
     * @ORM\Column(name="Ataskaitos_numeris", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $ataskaitosNumeris;

    /**
     * @var \AppBundle\Entity\AtaskaitosTipai
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\AtaskaitosTipai")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Tipas", referencedColumnName="id")
     * })
     */
    private $tipas;

    /**
     * @return \DateTime
     */
    public function getNuoKada()
    {
        return $this->nuoKada;
    }

    /**
     * @param \DateTime $nuoKada
     * @return Ataskaitos
     */
    public function setNuoKada($nuoKada)
    {
        $this->nuoKada = $nuoKada;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getIkiKada()
    {
        return $this->ikiKada;
    }

    /**
     * @param \DateTime $ikiKada
     * @return Ataskaitos
     */
    public function setIkiKada($ikiKada)
    {
        $this->ikiKada = $ikiKada;
        return $this;
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
     * @return Ataskaitos
     */
    public function setSukurimoData($sukurimoData)
    {
        $this->sukurimoData = $sukurimoData;
        return $this;
    }

    /**
     * @return int
     */
    public function getAtaskaitosNumeris()
    {
        return $this->ataskaitosNumeris;
    }

    /**
     * @param int $ataskaitosNumeris
     * @return Ataskaitos
     */
    public function setAtaskaitosNumeris($ataskaitosNumeris)
    {
        $this->ataskaitosNumeris = $ataskaitosNumeris;
        return $this;
    }

    /**
     * @return AtaskaitosTipai
     */
    public function getTipas()
    {
        return $this->tipas;
    }

    /**
     * @param AtaskaitosTipai $tipas
     * @return Ataskaitos
     */
    public function setTipas($tipas)
    {
        $this->tipas = $tipas;
        return $this;
    }


}

