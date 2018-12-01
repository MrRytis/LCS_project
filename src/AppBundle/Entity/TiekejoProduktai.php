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

