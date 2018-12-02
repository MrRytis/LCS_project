<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use AppBundle\Entity\Status;
use AppBundle\Entity\Category;

/**
 * Daiktai
 *
 * @ORM\Table(name="daiktai", indexes={@ORM\Index(name="Priklauso1", columns={"fk_Kategorijaid"}), @ORM\Index(name="Turi7", columns={"fk_Busenaid"})})
 * @ORM\Entity
 */
class Item
{
    /**
     * @var string
     *
     * @ORM\Column(name="Pavadinimas", type="string", length=255, nullable=false)
     */
    private $name;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="Pridejimo_data", type="date", nullable=false)
     */
    private $added;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="Nurasymo_Data", type="date", nullable=true)
     */
    private $deleted;

    /**
     * @var float
     *
     * @ORM\Column(name="Verte", type="float", precision=10, scale=0, nullable=false)
     */
    private $value;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var \AppBundle\Entity\Category
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Kategorijos")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="fk_Kategorijaid", referencedColumnName="id")
     * })
     */
    private $category;

    /**
     * @var \AppBundle\Entity\Status
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Busenos")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="fk_Busenaid", referencedColumnName="id")
     * })
     */
    private $status;

    public function setName($value)
    {
        $this->name = $value;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setAdded($value)
    {
        $this->added = $value;
    }

    public function getAdded()
    {
        return $this->added;
    }

    public function setDeleted($value)
    {
        $this->deleted = $value;
    }

    public function getDeleted()
    {
        return $this->deleted;
    }

    public function setValue($value)
    {
        $this->value = $value;
    }

    public function getValue()
    {
        return $this->value;
    }

    public function setId($value)
    {
        $this->id = $value;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setCategory($value)
    {
        $this->category = $value;
    }

    public function getCategory()
    {
        return $this->category;
    }

    public function setStatus($value)
    {
        $this->status = $value;
    }

    public function getStatus()
    {
        return $this->status;
    }
}

