<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Matmenys
 *
 * @ORM\Table(name="matmenys")
 * @ORM\Entity
 */
class Matmenys
{
    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=11, nullable=false)
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

