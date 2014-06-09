<?php

namespace Dev\AeroportBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Compagnie
 *
 * @ORM\Table(name="compagnie")
 * @ORM\Entity(repositoryClass="Dev\AeroportBundle\Entity\CompagnieRepository")
 */
class Compagnie
{
    /**
     * @var integer
     *
     * @ORM\Column(name="compagnie_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $compagnieId;

    /**
     * @var string
     *
     * @ORM\Column(name="compagnie_nom", type="string", length=100, nullable=false)
     */
    private $compagnieNom;



    /**
     * Get compagnieId
     *
     * @return integer 
     */
    public function getCompagnieId()
    {
        return $this->compagnieId;
    }

    /**
     * Set compagnieNom
     *
     * @param string $compagnieNom
     * @return Compagnie
     */
    public function setCompagnieNom($compagnieNom)
    {
        $this->compagnieNom = $compagnieNom;
    
        return $this;
    }

    /**
     * Get compagnieNom
     *
     * @return string 
     */
    public function getCompagnieNom()
    {
        return $this->compagnieNom;
    }
}