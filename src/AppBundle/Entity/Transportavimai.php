<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Transportavimai
 *
 * @ORM\Table(name="transportavimai", indexes={@ORM\Index(name="Siuntimo_budas", columns={"Siuntimo_budas"}), @ORM\Index(name="turi_priskirta", columns={"fk_Uzsakymasid"})})
 * @ORM\Entity
 */
class Transportavimai
{
    /**
     * @var string
     *
     * @ORM\Column(name="Pristatymo_adresas", type="string", length=255, nullable=true)
     */
    private $pristatymoAdresas;

    /**
     * @var string
     *
     * @ORM\Column(name="Issiuntimo_adresas", type="string", length=255, nullable=true)
     */
    private $issiuntimoAdresas;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var \AppBundle\Entity\SiuntimoBudai
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\SiuntimoBudai")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Siuntimo_budas", referencedColumnName="id")
     * })
     */
    private $siuntimoBudas;

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
     * @return string
     */
    public function getPristatymoAdresas()
    {
        return $this->pristatymoAdresas;
    }

    /**
     * @param string $pristatymoAdresas
     * @return Transportavimai
     */
    public function setPristatymoAdresas($pristatymoAdresas)
    {
        $this->pristatymoAdresas = $pristatymoAdresas;
        return $this;
    }

    /**
     * @return string
     */
    public function getIssiuntimoAdresas()
    {
        return $this->issiuntimoAdresas;
    }

    /**
     * @param string $issiuntimoAdresas
     * @return Transportavimai
     */
    public function setIssiuntimoAdresas($issiuntimoAdresas)
    {
        $this->issiuntimoAdresas = $issiuntimoAdresas;
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
     * @return Transportavimai
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return SiuntimoBudai
     */
    public function getSiuntimoBudas()
    {
        return $this->siuntimoBudas;
    }

    /**
     * @param SiuntimoBudai $siuntimoBudas
     * @return Transportavimai
     */
    public function setSiuntimoBudas($siuntimoBudas)
    {
        $this->siuntimoBudas = $siuntimoBudas;
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
     * @return Transportavimai
     */
    public function setFkUzsakymasid($fkUzsakymasid)
    {
        $this->fkUzsakymasid = $fkUzsakymasid;
        return $this;
    }


}

