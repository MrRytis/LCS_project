<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Produktai
 *
 * @ORM\Table(name="produktai", indexes={@ORM\Index(name="Apibudina", columns={"fk_Medziagu_grupeid"})})
 * @ORM\Entity
 */
class Produktai
{
    /**
     * @var string
     *
     * @ORM\Column(name="Pavadinimas", type="string", length=255, nullable=true)
     */
    private $pavadinimas;

    /**
     * @var float
     *
     * @ORM\Column(name="Kaina", type="float", precision=10, scale=0, nullable=true)
     */
    private $kaina;

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
     * @var \AppBundle\Entity\MedziaguGrupes
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\MedziaguGrupes")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="fk_Medziagu_grupeid", referencedColumnName="id")
     * })
     */
    private $fkMedziaguGrupeid;


}

