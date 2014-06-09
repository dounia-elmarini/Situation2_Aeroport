<?php

namespace Dev\AeroportBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Ville
 *
 * @ORM\Table(name="ville")
 * @ORM\Entity(repositoryClass="Dev\AeroportBundle\Entity\VilleRepository")
 */
class Ville
{
    /**
     * @var integer
     *
     * @ORM\Column(name="ville_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $villeId;

    /**
     * @var string
     *
     * @ORM\Column(name="ville_nom", type="string", length=100, nullable=false)
     */
    private $villeNom;



    /**
     * Get villeId
     *
     * @return integer 
     */
    public function getVilleId()
    {
        return $this->villeId;
    }

    /**
     * Set villeNom
     *
     * @param string $villeNom
     * @return Ville
     */
    public function setVilleNom($villeNom)
    {
        $this->villeNom = $villeNom;
    
        return $this;
    }

    /**
     * Get villeNom
     *
     * @return string 
     */
    public function getVilleNom()
    {
        return $this->villeNom;
    }
}