<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Atsiskaitymai
 *
 * @ORM\Table(name="atsiskaitymai", uniqueConstraints={@ORM\UniqueConstraint(name="fk_Uzsakymasid", columns={"fk_Uzsakymasid"}), @ORM\UniqueConstraint(name="fk_Klientasid", columns={"fk_Klientasid"})})
 * @ORM\Entity
 */
class Atsiskaitymai
{
    /**
     * @var float
     *
     * @ORM\Column(name="Suma", type="float", precision=10, scale=0, nullable=true)
     */
    private $suma;

    /**
     * @var string
     *
     * @ORM\Column(name="Korteles_nr", type="string", length=255, nullable=true)
     */
    private $kortelesNr;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="Data", type="date", nullable=true)
     */
    private $data;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

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
     * @var \AppBundle\Entity\Klientai
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Klientai")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="fk_Klientasid", referencedColumnName="id")
     * })
     */
    private $fkKlientasid;


}

