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
     * @var \AppBundle\Entity\Klientai
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Klientai")
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


}

