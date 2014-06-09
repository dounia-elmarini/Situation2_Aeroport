<?php

namespace Dev\AeroportBundle\Manager;

use Dev\AeroportBundle\Entity\Ville;
use Dev\AeroportBundle\Entity\VilleRepository;



class VilleManager
{
    
    protected $entityManager;
    protected $repository;
    
    public function __construct($em)
    {
        $this->entityManager = $em;
        $this->repository = $em->getRepository('DevAeroportBundle:Ville');
    }
    
    public function loadAllVilles()
    {
        $villes = $this->repository->findAll();
        return $villes;
    }
    
    
    /**
    * Load Ville entity
    *
    * @param Integer $villeId
    */
    public function loadVille($villeId)
    {
        return $this->repository->find($villeId);
    }
    
    
    
    /**
    * Save Ville entity
    *
    * @param Ville $ville
    */
    public function saveVille(Ville $ville)
    {
        $this->entityManager->persist($ville);
        $this->entityManager->flush();
    }
    
    /**
    * Remove Ville entity
    *
    * @param Integer $villeId 
    */
    public function removeVille(Ville $ville)
    {
        $this->entityManager->remove($ville);
        $this->entityManager->flush();
    }
    
    
    
}

?>
