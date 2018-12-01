<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * NaudojamiDaiktai
 *
 * @ORM\Table(name="naudojami_daiktai", indexes={@ORM\Index(name="Naudoja", columns={"fk_Darbuotojasid"}), @ORM\Index(name="Paimtas", columns={"fk_Daiktasid"})})
 * @ORM\Entity
 */
class NaudojamiDaiktai
{
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="Paimtas", type="date", nullable=false)
     */
    private $paimtas;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="Padetas", type="date", nullable=true)
     */
    private $padetas;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var \AppBundle\Entity\Darbuotojai
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Darbuotojai")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="fk_Darbuotojasid", referencedColumnName="id")
     * })
     */
    private $fkDarbuotojasid;

    /**
     * @var \AppBundle\Entity\Daiktai
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Daiktai")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="fk_Daiktasid", referencedColumnName="id")
     * })
     */
    private $fkDaiktasid;


}

