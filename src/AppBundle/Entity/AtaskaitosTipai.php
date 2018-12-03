<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * AtaskaitosTipai
 *
 * @ORM\Table(name="ataskaitos_tipai")
 * @ORM\Entity
 */
class AtaskaitosTipai
{
    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=9, nullable=false)
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

