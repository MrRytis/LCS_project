<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Kategorijos
 *
 * @ORM\Table(name="kategorijos")
 * @ORM\Entity
 */
class Kategorijos
{
    /**
     * @var string
     *
     * @ORM\Column(name="Pavadinimas", type="string", length=255, nullable=false)
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

