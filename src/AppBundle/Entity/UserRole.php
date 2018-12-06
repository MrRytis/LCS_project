<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * VartotojuRoles
 *
 * @ORM\Table(name="vartotoju_roles")
 * @ORM\Entity
 */
class UserRole
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

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return UserRole
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
     * @return UserRole
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }


}

