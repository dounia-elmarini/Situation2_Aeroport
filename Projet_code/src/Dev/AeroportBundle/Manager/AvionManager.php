<?php

namespace Dev\AeroportBundle\Manager;

use Dev\AeroportBundle\Entity\Avion;
use Dev\AeroportBundle\Entity\AvionRepository;



class AvionManager
{
    
    protected $entityManager;
    protected $repository;
    
    public function __construct($em)
    {
        $this->entityManager = $em;
        $this->repository = $em->getRepository('DevAeroportBundle:Avion');
    }
    
    public function loadAllAvions()
    {
        $avions = $this->repository->findAll();
        return $avions;
    }
    
    
    /**
    * Load Avion entity
    *
    * @param Integer $avionId
    */
    public function loadAvion($avionId)
    {
        return $this->repository->find($avionId);
    }
    
    
    
    /**
    * Save Avion entity
    *
    * @param Avion $avion
    */
    public function saveAvion(Avion $avion)
    {
        $this->entityManager->persist($avion);
        $this->entityManager->flush();
    }
    
    /**
    * Remove Avion entity
    *
    * @param Integer $avionId 
    */
    public function removeAvion(Avion $avion)
    {
        $this->entityManager->remove($avion);
        $this->entityManager->flush();
    }
    
    
    
}

?>
