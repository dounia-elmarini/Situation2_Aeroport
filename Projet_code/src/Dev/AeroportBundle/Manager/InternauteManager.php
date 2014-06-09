<?php

namespace Dev\AeroportBundle\Manager;

use Dev\AeroportBundle\Entity\Internaute;
use Dev\AeroportBundle\Entity\InternauteRepository;



class InternauteManager
{
    
    protected $entityManager;
    protected $repository;
    
    public function __construct($em)
    {
        $this->entityManager = $em;
        $this->repository = $em->getRepository('DevAeroportBundle:Internaute');
    }
    
    public function loadAllInternautes()
    {
        $internautes = $this->repository->findAll();
        return $internautes;
    }
    
    
    /**
    * Load Internaute entity
    *
    * @param Integer $internauteId
    */
    public function loadInternaute($internauteId)
    {
        return $this->repository->find($internauteId);
    }
    
    
    
    /**
    * Save Internaute entity
    *
    * @param Internaute $internaute
    */
    public function saveInternaute(Internaute $internaute)
    {
        $this->entityManager->persist($internaute);
        $this->entityManager->flush();
    }
    
    /**
    * Remove Internaute entity
    *
    * @param Integer $internauteId 
    */
    public function removeInternaute(Internaute $internaute)
    {
        $this->entityManager->remove($internaute);
        $this->entityManager->flush();
    }
    
    
    
}

?>
