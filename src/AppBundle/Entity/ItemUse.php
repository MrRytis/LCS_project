<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use AppBundle\Entity\Worker;
use AppBundle\Entity\Item;

/**
 * NaudojamiDaiktai
 *
 * @ORM\Table(name="naudojami_daiktai", indexes={@ORM\Index(name="Naudoja", columns={"fk_Darbuotojasid"}), @ORM\Index(name="Paimtas", columns={"fk_Daiktasid"})})
 * @ORM\Entity
 */
class ItemUse
{
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="Paimtas", type="date", nullable=false)
     */
    private $taken;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="Padetas", type="date", nullable=true)
     */
    private $returned;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var \AppBundle\Entity\Worker
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Worker")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="fk_Darbuotojasid", referencedColumnName="id")
     * })
     */
    private $worker;

    /**
     * @var \AppBundle\Entity\Item
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Item")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="fk_Daiktasid", referencedColumnName="id")
     * })
     */
    private $item;

    public function setTaken($value)
    {
        $this->taken = $value;
    }

    public function getTaken()
    {
        return $this->taken;
    }

    public function setReturned($value)
    {
        $this->returned = $value;
    }

    public function getReturned()
    {
        return $this->returned;
    }

    public function setId($value)
    {
        $this->id = $value;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setWorker($value)
    {
        $this->worker = $value;
    }

    public function getWorker()
    {
        return $this->worker;
    }

    public function setItem($value)
    {
        $this->item = $value;
    }

    public function getItem()
    {
        return $this->item;
    }
}

