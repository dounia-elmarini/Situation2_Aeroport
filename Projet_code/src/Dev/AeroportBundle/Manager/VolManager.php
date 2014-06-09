<?php

namespace Dev\AeroportBundle\Manager;

use Dev\AeroportBundle\Entity\Vol;
use Dev\AeroportBundle\Entity\VolRepository;



class VolManager
{
    
    protected $entityManager;
    protected $repository;
    
    public function __construct($em)
    {
        $this->entityManager = $em;
        $this->repository = $em->getRepository('DevAeroportBundle:Vol');
    }
    
    public function loadAllVols()
    {
        $vols = $this->repository->findAll();
        return $vols;
    }
    
    
    /**
    * Load Vol entity
    *
    * @param Integer $volId
    */
    public function loadVol($volId)
    {
        return $this->repository->find($volId);
    }
    
    
    /**
    * Load Reservations
    *
    * @param Integer $volId
    */
    public function loadReservationsVol($volId)
    {
        return $this->repository->getReservationsVol($volId);
    }
    
    
    
    
    
    /**
    * Save Vol entity
    *
    * @param Vol $vol
    */
    public function saveVol(Vol $vol)
    {
        $this->entityManager->persist($vol);
        $this->entityManager->flush();
    }
    
    /**
    * Remove Vol entity
    *
    * @param Integer $volId 
    */
    public function removeVol(Vol $vol)
    {
        $this->entityManager->remove($vol);
        $this->entityManager->flush();
    }
    
    
    
}

?>
