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


}

