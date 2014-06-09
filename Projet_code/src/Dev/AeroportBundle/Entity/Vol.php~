<?php

namespace Dev\AeroportBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Vol
 *
 * @ORM\Table(name="vol")
 * @ORM\Entity(repositoryClass="Dev\AeroportBundle\Entity\VolRepository")
 */
class Vol
{
    /**
     * @var integer
     *
     * @ORM\Column(name="vol_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $volId;

    /**
     * @var string
     *
     * @ORM\Column(name="vol_nom", type="string", length=100, nullable=false)
     */
    private $volNom;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="vol_date_dep", type="datetime", nullable=false)
     */
    private $volDateDep;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="vol_date_arriv", type="datetime", nullable=false)
     */
    private $volDateArriv;

    /**
     * @var \Compagnie
     *
     * @ORM\ManyToOne(targetEntity="Compagnie")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="vol_comp_id", referencedColumnName="compagnie_id")
     * })
     */
    private $volComp;

    /**
     * @var \Ville
     *
     * @ORM\ManyToOne(targetEntity="Ville")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="vol_ville_dep_id", referencedColumnName="ville_id")
     * })
     */
    private $volVilleDep;

    /**
     * @var \Ville
     *
     * @ORM\ManyToOne(targetEntity="Ville")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="vol_ville_arriv_id", referencedColumnName="ville_id")
     * })
     */
    private $volVilleArriv;

    /**
     * @var \Avion
     *
     * @ORM\ManyToOne(targetEntity="Avion")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="vol_avion_id", referencedColumnName="avion_id")
     * })
     */
    private $volAvion;



    /**
     * Get volId
     *
     * @return integer 
     */
    public function getVolId()
    {
        return $this->volId;
    }

    /**
     * Set volNom
     *
     * @param string $volNom
     * @return Vol
     */
    public function setVolNom($volNom)
    {
        $this->volNom = $volNom;
    
        return $this;
    }

    /**
     * Get volNom
     *
     * @return string 
     */
    public function getVolNom()
    {
        return $this->volNom;
    }

    /**
     * Set volDateDep
     *
     * @param \DateTime $volDateDep
     * @return Vol
     */
    public function setVolDateDep($volDateDep)
    {
        $this->volDateDep = $volDateDep;
    
        return $this;
    }

    /**
     * Get volDateDep
     *
     * @return \DateTime 
     */
    public function getVolDateDep()
    {
        return $this->volDateDep;
    }

    /**
     * Set volDateArriv
     *
     * @param \DateTime $volDateArriv
     * @return Vol
     */
    public function setVolDateArriv($volDateArriv)
    {
        $this->volDateArriv = $volDateArriv;
    
        return $this;
    }

    /**
     * Get volDateArriv
     *
     * @return \DateTime 
     */
    public function getVolDateArriv()
    {
        return $this->volDateArriv;
    }

    /**
     * Set volComp
     *
     * @param \Dev\AeroportBundle\Entity\Compagnie $volComp
     * @return Vol
     */
    public function setVolComp(\Dev\AeroportBundle\Entity\Compagnie $volComp = null)
    {
        $this->volComp = $volComp;
    
        return $this;
    }

    /**
     * Get volComp
     *
     * @return \Dev\AeroportBundle\Entity\Compagnie 
     */
    public function getVolComp()
    {
        return $this->volComp;
    }

    /**
     * Set volVilleDep
     *
     * @param \Dev\AeroportBundle\Entity\Ville $volVilleDep
     * @return Vol
     */
    public function setVolVilleDep(\Dev\AeroportBundle\Entity\Ville $volVilleDep = null)
    {
        $this->volVilleDep = $volVilleDep;
    
        return $this;
    }

    /**
     * Get volVilleDep
     *
     * @return \Dev\AeroportBundle\Entity\Ville 
     */
    public function getVolVilleDep()
    {
        return $this->volVilleDep;
    }

    /**
     * Set volVilleArriv
     *
     * @param \Dev\AeroportBundle\Entity\Ville $volVilleArriv
     * @return Vol
     */
    public function setVolVilleArriv(\Dev\AeroportBundle\Entity\Ville $volVilleArriv = null)
    {
        $this->volVilleArriv = $volVilleArriv;
    
        return $this;
    }

    /**
     * Get volVilleArriv
     *
     * @return \Dev\AeroportBundle\Entity\Ville 
     */
    public function getVolVilleArriv()
    {
        return $this->volVilleArriv;
    }

    /**
     * Set volAvion
     *
     * @param \Dev\AeroportBundle\Entity\Avion $volAvion
     * @return Vol
     */
    public function setVolAvion(\Dev\AeroportBundle\Entity\Avion $volAvion = null)
    {
        $this->volAvion = $volAvion;
    
        return $this;
    }

    /**
     * Get volAvion
     *
     * @return \Dev\AeroportBundle\Entity\Avion 
     */
    public function getVolAvion()
    {
        return $this->volAvion;
    }
}