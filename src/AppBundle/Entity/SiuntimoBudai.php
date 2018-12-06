<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * SiuntimoBudai
 *
 * @ORM\Table(name="siuntimo_budai")
 * @ORM\Entity
 */
class SiuntimoBudai
{
    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=8, nullable=false)
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
     * @return SiuntimoBudai
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
     * @return SiuntimoBudai
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }


}

