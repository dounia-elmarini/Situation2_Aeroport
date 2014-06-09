<?php

namespace Dev\AeroportBundle\Manager;

use Dev\AeroportBundle\Entity\Compagnie;
use Dev\AeroportBundle\Entity\CompagnieRepository;



class CompagnieManager
{
    
    protected $entityManager;
    protected $repository;
    
    public function __construct($em)
    {
        $this->entityManager = $em;
        $this->repository = $em->getRepository('DevAeroportBundle:Compagnie');
    }
    
    public function loadAllCompagnies()
    {
        $compagnies = $this->repository->findAll();
        return $compagnies;
    }
    
    
    /**
    * Load Compagnie entity
    *
    * @param Integer $compagnieId
    */
    public function loadCompagnie($compagnieId)
    {
        return $this->repository->find($compagnieId);
    }
    
    
    
    /**
    * Save Compagnie entity
    *
    * @param Compagnie $compagnie
    */
    public function saveCompagnie(Compagnie $compagnie)
    {
        $this->entityManager->persist($compagnie);
        $this->entityManager->flush();
    }
    
    /**
    * Remove Compagnie entity
    *
    * @param Integer $compagnieId 
    */
    public function removeCompagnie(Compagnie $compagnie)
    {
        $this->entityManager->remove($compagnie);
        $this->entityManager->flush();
    }
    
    
    
}

?>
