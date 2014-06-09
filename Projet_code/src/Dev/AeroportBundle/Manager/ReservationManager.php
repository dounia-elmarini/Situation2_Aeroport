<?php

namespace Dev\AeroportBundle\Manager;

use Dev\AeroportBundle\Entity\Reserve;
use Dev\AeroportBundle\Entity\ReserveRepository;



class ReservationManager
{
    
    protected $entityManager;
    protected $repository;
    
    public function __construct($em)
    {
        $this->entityManager = $em;
        $this->repository = $em->getRepository('DevAeroportBundle:Reserve');
    }
    
    public function loadAllReservations()
    {
        $reservations = $this->repository->findAll();
        return $reservations;
    }
    
    
    /**
    * Load Reservation entity
    *
    * @param Integer $reservationId
    */
    public function loadReservation($reservationId)
    {
        return $this->repository->find($reservationId);
    }
    
    /**
    * Load Reservation entity
    *
    * @param Integer $cliId
    */
    public function loadReservationsClient($cliId)
    {
        return $this->repository->getReservationsClient($cliId);
    }
    
    
    
    
    
    
    /**
    * Save Reservation entity
    *
    * @param Reservation $reservation
    */
    public function saveReservation(Reserve $reservation)
    {
        $this->entityManager->persist($reservation);
        $this->entityManager->flush();
    }
    
    
    
    /**
    * Remove Reservation entity
    *
    * @param Integer $cliId 
    */
    public function removeReservation($volId, $cliId)
    {
        
        
        
        $this->repository->removeReservation($volId, $cliId);
    }
    
    
    
}

?>
