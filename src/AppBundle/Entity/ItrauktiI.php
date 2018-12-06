<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ItrauktiI
 *
 * @ORM\Table(name="itraukti_i", indexes={@ORM\Index(name="IDX_BF988184B9D2654C", columns={"fk_AtaskaitaAtaskaitos_numeris"})})
 * @ORM\Entity
 */
class ItrauktiI
{
    /**
     * @var integer
     *
     * @ORM\Column(name="fk_Uzsakymasid", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $fkUzsakymasid;

    /**
     * @var \AppBundle\Entity\Ataskaitos
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\OneToOne(targetEntity="AppBundle\Entity\Ataskaitos")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="fk_AtaskaitaAtaskaitos_numeris", referencedColumnName="Ataskaitos_numeris")
     * })
     */
    private $fkAtaskaitaataskaitosNumeris;

    /**
     * @return int
     */
    public function getFkUzsakymasid()
    {
        return $this->fkUzsakymasid;
    }

    /**
     * @param int $fkUzsakymasid
     * @return ItrauktiI
     */
    public function setFkUzsakymasid($fkUzsakymasid)
    {
        $this->fkUzsakymasid = $fkUzsakymasid;
        return $this;
    }

    /**
     * @return Ataskaitos
     */
    public function getFkAtaskaitaataskaitosNumeris()
    {
        return $this->fkAtaskaitaataskaitosNumeris;
    }

    /**
     * @param Ataskaitos $fkAtaskaitaataskaitosNumeris
     * @return ItrauktiI
     */
    public function setFkAtaskaitaataskaitosNumeris($fkAtaskaitaataskaitosNumeris)
    {
        $this->fkAtaskaitaataskaitosNumeris = $fkAtaskaitaataskaitosNumeris;
        return $this;
    }


}

