<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Tiekejai
 *
 * @ORM\Table(name="tiekejai")
 * @ORM\Entity
 */
class Tiekejai
{
    /**
     * @var string
     *
     * @ORM\Column(name="Vardas", type="string", length=255, nullable=true)
     */
    private $vardas;

    /**
     * @var string
     *
     * @ORM\Column(name="Firmos_pav", type="string", length=255, nullable=true)
     */
    private $firmosPav;

    /**
     * @var string
     *
     * @ORM\Column(name="E_pastas", type="string", length=255, nullable=true)
     */
    private $ePastas;

    /**
     * @var string
     *
     * @ORM\Column(name="Vadybininkas", type="string", length=255, nullable=true)
     */
    private $vadybininkas;

    /**
     * @var integer
     *
     * @ORM\Column(name="Fakturos_Nr", type="integer", nullable=true)
     */
    private $fakturosNr;

    /**
     * @var string
     *
     * @ORM\Column(name="Vadybininko_e_pastas", type="string", length=255, nullable=true)
     */
    private $vadybininkoEPastas;

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


}

