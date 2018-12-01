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


}

