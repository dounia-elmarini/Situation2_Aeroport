<?php

namespace Dev\AeroportBundle\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;

use Dev\AeroportBundle\Entity\Client;
use Dev\AeroportBundle\Manager\InternauteManager;
use Dev\AeroportBundle\Form\ClientModel;



class ClientController extends Controller
{
    
    
    private function getManager()
    {
        return new InternauteManager($this->getDoctrine()->getEntityManager());
    }
    
    
    
    /**
     * @Route("/admin/client", name="admin_client_index")
     * @Template()
     */
    public function indexAction()
    {
        
        // Obtention du manager et de la liste des clients
        $clients = $this->getManager()->loadAllInternautes();
        
        return array('arrayClients' => $clients);
    }
    
    
   
    
    
    /**
     * @Route("/admin/client/delete", name="admin_client_delete")
     * @Template()
     */
    public function deleteAction()
    {
        
        // Obtention de l'objet "request"
        $request = $this->get('request');
        // Si l'utilisateur soumet le formulaire
        if ($request->getMethod() == 'POST')
        {
            
            $id = $request->request->get("id");
            
            // Obtention du manager
            $manager = $this->getManager();
            // Recherche de la client
            if (!$client = $manager->loadInternaute($id))
            {
                throw new NotFoundHttpException("La client n'existe pas");
            }

            $message = sprintf("Le client num %u a ete supprime", $id);
            $status = 0;
            // Suppression de la client
            try
            {
                $manager->removeInternaute($client);
            }
            catch (Exception $e)
            {
                $message = sprintf("L erreur suivante est survenue lors de la suppression de la client num %u : %s",
                        $id, $e->getMessage());
                $status = -1;
            }
        }
        else
        {
            $message = "L'appel à la méthode de suppression est incorrecte";
            $status = $id = -1;
        }
 
        
        // Retour du résultat en Json
        $response = new Response(json_encode(array('status' => $status, 'message' => $message, 'id' => $id)));
        $response->headers->set('Content-Type', 'application/json');
        return $response;
        
        
    }
    
    
}
