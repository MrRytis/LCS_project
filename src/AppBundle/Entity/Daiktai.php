<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Daiktai
 *
 * @ORM\Table(name="daiktai", indexes={@ORM\Index(name="Priklauso1", columns={"fk_Kategorijaid"}), @ORM\Index(name="Turi7", columns={"fk_Busenaid"})})
 * @ORM\Entity
 */
class Daiktai
{
    /**
     * @var string
     *
     * @ORM\Column(name="Pavadinimas", type="string", length=255, nullable=false)
     */
    private $pavadinimas;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="Pridejimo_data", type="date", nullable=false)
     */
    private $pridejimoData;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="Nurasymo_Data", type="date", nullable=true)
     */
    private $nurasymoData;

    /**
     * @var float
     *
     * @ORM\Column(name="Verte", type="float", precision=10, scale=0, nullable=false)
     */
    private $verte;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var \AppBundle\Entity\Kategorijos
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Kategorijos")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="fk_Kategorijaid", referencedColumnName="id")
     * })
     */
    private $fkKategorijaid;

    /**
     * @var \AppBundle\Entity\Busenos
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Busenos")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="fk_Busenaid", referencedColumnName="id")
     * })
     */
    private $fkBusenaid;


}

