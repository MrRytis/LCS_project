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

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return Uzpildai
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return Uzpildai
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    public function __toString()
    {
        return $this->name;
    }


}

