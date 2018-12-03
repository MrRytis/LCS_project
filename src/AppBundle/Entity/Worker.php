<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use AppBundle\Entity\LcsUser;

/**
 * Darbuotojai
 *
 * @ORM\Table(name="darbuotojai", uniqueConstraints={@ORM\UniqueConstraint(name="fk_Paskyraid", columns={"fk_Paskyraid"})})
 * @ORM\Entity
 */
class Worker
{
    /**
     * @var float
     *
     * @ORM\Column(name="Atlyginimas", type="float", precision=10, scale=0, nullable=true)
     */
    private $salary;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var \AppBundle\Entity\LcsUser
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\LcsUser")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="fk_Paskyraid", referencedColumnName="id")
     * })
     */
    private $account;


}

