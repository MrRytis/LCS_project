<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Uzsakymai
 *
 * @ORM\Table(name="uzsakymai", indexes={@ORM\Index(name="Pakuotes_ismatavimai", columns={"Pakuotes_ismatavimai"}), @ORM\Index(name="Pakuotes_uzpildas", columns={"Pakuotes_uzpildas"}), @ORM\Index(name="Priklauso2", columns={"fk_Klientasid"})})
 * @ORM\Entity
 */
class Uzsakymai
{
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="Data", type="date", nullable=true)
     */
    private $data;

    /**
     * @var boolean
     *
     * @ORM\Column(name="Apmokejima_busena", type="boolean", nullable=true)
     */
    private $apmokejimaBusena;

    /**
     * @var boolean
     *
     * @ORM\Column(name="Draudimas", type="boolean", nullable=true)
     */
    private $draudimas;

    /**
     * @var boolean
     *
     * @ORM\Column(name="Sekimas", type="boolean", nullable=true)
     */
    private $sekimas;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

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
     * @var \AppBundle\Entity\Matmenys
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Matmenys")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Pakuotes_ismatavimai", referencedColumnName="id")
     * })
     */
    private $pakuotesIsmatavimai;

    /**
     * @var \AppBundle\Entity\Uzpildai
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Uzpildai")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Pakuotes_uzpildas", referencedColumnName="id")
     * })
     */
    private $pakuotesUzpildas;

    /**
     * @return \DateTime
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * @param \DateTime $data
     * @return Uzsakymai
     */
    public function setData($data)
    {
        $this->data = $data;
        return $this;
    }

    /**
     * @return bool
     */
    public function isApmokejimaBusena()
    {
        return $this->apmokejimaBusena;
    }

    /**
     * @param bool $apmokejimaBusena
     * @return Uzsakymai
     */
    public function setApmokejimaBusena($apmokejimaBusena)
    {
        $this->apmokejimaBusena = $apmokejimaBusena;
        return $this;
    }

    /**
     * @return bool
     */
    public function isDraudimas()
    {
        return $this->draudimas;
    }

    /**
     * @param bool $draudimas
     * @return Uzsakymai
     */
    public function setDraudimas($draudimas)
    {
        $this->draudimas = $draudimas;
        return $this;
    }

    /**
     * @return bool
     */
    public function isSekimas()
    {
        return $this->sekimas;
    }

    /**
     * @param bool $sekimas
     * @return Uzsakymai
     */
    public function setSekimas($sekimas)
    {
        $this->sekimas = $sekimas;
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
     * @return Uzsakymai
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return Klientai
     */
    public function getFkKlientasid()
    {
        return $this->fkKlientasid;
    }

    /**
     * @param Klientai $fkKlientasid
     * @return Uzsakymai
     */
    public function setFkKlientasid($fkKlientasid)
    {
        $this->fkKlientasid = $fkKlientasid;
        return $this;
    }

    /**
     * @return Matmenys
     */
    public function getPakuotesIsmatavimai()
    {
        return $this->pakuotesIsmatavimai;
    }

    /**
     * @param Matmenys $pakuotesIsmatavimai
     * @return Uzsakymai
     */
    public function setPakuotesIsmatavimai($pakuotesIsmatavimai)
    {
        $this->pakuotesIsmatavimai = $pakuotesIsmatavimai;
        return $this;
    }

    /**
     * @return Uzpildai
     */
    public function getPakuotesUzpildas()
    {
        return $this->pakuotesUzpildas;
    }

    /**
     * @param Uzpildai $pakuotesUzpildas
     * @return Uzsakymai
     */
    public function setPakuotesUzpildas($pakuotesUzpildas)
    {
        $this->pakuotesUzpildas = $pakuotesUzpildas;
        return $this;
    }


}

