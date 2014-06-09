<?php

namespace Dev\AeroportBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Avion
 *
 * @ORM\Table(name="avion")
 * @ORM\Entity(repositoryClass="Dev\AeroportBundle\Entity\AvionRepository")
 */
class Avion
{
    /**
     * @var integer
     *
     * @ORM\Column(name="avion_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $avionId;

    /**
     * @var string
     *
     * @ORM\Column(name="avion_nom", type="string", length=100, nullable=false)
     */
    private $avionNom;

    /**
     * @var integer
     *
     * @ORM\Column(name="avion_capacite", type="integer", nullable=false)
     */
    private $avionCapacite;



    /**
     * Get avionId
     *
     * @return integer 
     */
    public function getAvionId()
    {
        return $this->avionId;
    }

    /**
     * Set avionNom
     *
     * @param string $avionNom
     * @return Avion
     */
    public function setAvionNom($avionNom)
    {
        $this->avionNom = $avionNom;
    
        return $this;
    }

    /**
     * Get avionNom
     *
     * @return string 
     */
    public function getAvionNom()
    {
        return $this->avionNom;
    }

    /**
     * Set avionCapacite
     *
     * @param integer $avionCapacite
     * @return Avion
     */
    public function setAvionCapacite($avionCapacite)
    {
        $this->avionCapacite = $avionCapacite;
    
        return $this;
    }

    /**
     * Get avionCapacite
     *
     * @return integer 
     */
    public function getAvionCapacite()
    {
        return $this->avionCapacite;
    }
}