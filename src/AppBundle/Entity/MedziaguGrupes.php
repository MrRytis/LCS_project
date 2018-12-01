<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * MedziaguGrupes
 *
 * @ORM\Table(name="medziagu_grupes")
 * @ORM\Entity
 */
class MedziaguGrupes
{
    /**
     * @var string
     *
     * @ORM\Column(name="Pavadinimas", type="string", length=255, nullable=true)
     */
    private $pavadinimas;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;


}

