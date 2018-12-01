<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * VartotojuRoles
 *
 * @ORM\Table(name="vartotoju_roles")
 * @ORM\Entity
 */
class VartotojuRoles
{
    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=21, nullable=false)
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

