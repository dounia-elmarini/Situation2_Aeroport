<?php

namespace Dev\AeroportBundle\Controller\Client;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;

use Dev\AeroportBundle\Entity\Vol;
use Dev\AeroportBundle\Manager\VolManager;
use Dev\AeroportBundle\Form\VolModel;

use Dev\AeroportBundle\Entity\Reserve;
use Dev\AeroportBundle\Manager\ReservationManager;



class ReservationController extends Controller
{
    
    
    private function getVolManager()
    {
        return new VolManager($this->getDoctrine()->getEntityManager());
    }
    
    private function getReservationManager()
    {
        return new ReservationManager($this->getDoctrine()->getEntityManager());
    }
    
    
    
    /**
     * @Route("/client/reservation", name="client_reservation_index")
     * @Template()
     */
    public function indexAction()
    {
        
        // Obtention du manager et de la liste des vols
        $vols = $this->getVolManager()->loadAllVols();
        
        return array('arrayVols' => $vols);
    }
    
    
    
    
    
    /**
     * @Route("/client/reservation/mesreservations", name="client_reservation_mesreservations")
     * @Template()
     */
    public function mesreservationsAction()
    {
        
        // Obtention du manager et de la liste des vols
        $vols = $this->getVolManager()->loadAllVols();
        $reservations = $this->getReservationManager()->loadReservationsClient($this->getUser()->getId());
        
        return array('arrayReservations' => $reservations);
    }
    
    
    
    
    /**
     * @Route("/client/reservation/volsdisponibles", name="client_reservation_volsdisponibles")
     * @Template()
     */
    public function volsdisponiblesAction()
    {
        
        // Obtention du manager et de la liste des vols
        $vols = $this->getVolManager()->loadAllVols();
        
        return array('arrayVols' => $vols);
    }
    
    
    
    
    /**
     * @Route("/client/reservation/add/{volId}", name="client_reservation_add")
     * @Template()
     */
    public function addAction($volId)
    {
        
        // Création d'une nouvelle réservation
        $reserve = new Reserve();
        
        $reserve->setVolId($volId);
        $reserve->setCliId($this->getUser()->getId());
        
        // Obtention du manager
        $manager = $this->getReservationManager();
        // Validation de l'entité
        $manager->saveReservation($reserve);
        
                
        // Redirection vers la page des vols
        return new RedirectResponse($this->generateUrl('client_reservation_volsdisponibles'));
        
        
        
        // On n'utilise pas le template par défaut mais le template de l'action 'edit'
        return $this->render('DevAeroportBundle:Admin/Vol:edit.html.twig', 
                array('form' => $model->createView(), 'vol' => $vol));
    }
    
    
    
    
    
    /**
     * @Route("/client/reservation/delete", name="client_reservation_delete")
     * @Template()
     */
    public function deleteAction()
    {
        
        // Obtention de l'objet "request"
        $request = $this->get('request');
        // Si l'utilisateur soumet le formulaire
        if ($request->getMethod() == 'POST')
        {
            
            $volId = $request->request->get("id");
            $cliId = $this->getUser()->getId();
            
            // Obtention du manager
            $manager = $this->getReservationManager();
            
            
            
            
            
            

            $message = sprintf("La reservation a ete supprime");
            $status = 0;
            // Suppression de la réservation
            try
            {
                $manager->removeReservation($volId, $cliId);
            }
            catch (Exception $e)
            {
                $message = sprintf("L erreur suivante est survenue lors de la suppression de la reservation",
                        $id, $e->getMessage());
                $status = -1;
            }
        }
        else
        {
            $message = "L'appel à la méthode de suppression est incorrecte";
            $status = -1;
        }
 
        
        // Retour du résultat en Json
        $response = new Response(json_encode(array('status' => $status, 'message' => $message)));
        $response->headers->set('Content-Type', 'application/json');
        return $response;
        
        
    }
    
    
}
