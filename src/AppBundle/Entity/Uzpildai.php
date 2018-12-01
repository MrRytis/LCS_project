<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Uzpildai
 *
 * @ORM\Table(name="uzpildai")
 * @ORM\Entity
 */
class Uzpildai
{
    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=17, nullable=false)
     */
    private $name;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;


}

