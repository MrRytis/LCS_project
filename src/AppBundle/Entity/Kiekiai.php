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
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Produktai")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="fk_Produktasid", referencedColumnName="id")
     * })
     */
    private $fkProduktasid;

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
     * @var \AppBundle\Entity\Uzsakymai
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Uzsakymai")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="fk_Uzsakymasid1", referencedColumnName="id")
     * })
     */
    private $fkUzsakymasid1;


}

