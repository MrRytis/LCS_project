<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Klientai
 *
 * @ORM\Table(name="klientai", uniqueConstraints={@ORM\UniqueConstraint(name="fk_Paskyraid", columns={"fk_Paskyraid"})})
 * @ORM\Entity
 */
class Klientai
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var \AppBundle\Entity\Paskyros
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Paskyros")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="fk_Paskyraid", referencedColumnName="id")
     * })
     */
    private $fkPaskyraid;


}

