<?php

namespace Dev\AeroportBundle\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;

use Dev\AeroportBundle\Entity\Vol;
use Dev\AeroportBundle\Manager\VolManager;
use Dev\AeroportBundle\Form\VolModel;



class VolController extends Controller
{
    
    
    private function getManager()
    {
        return new VolManager($this->getDoctrine()->getEntityManager());
    }
    
    
    
    /**
     * @Route("/admin/vol", name="admin_vol_index")
     * @Template()
     */
    public function indexAction()
    {
        
        // Obtention du manager et de la liste des vols
        $vols = $this->getManager()->loadAllVols();
        
        return array('arrayVols' => $vols);
    }
    
    
    
    /**
     * @Route("/admin/vol/add", name="admin_vol_add")
     * @Template()
     */
    public function addAction()
    {
        
        // Création d'une nouvelle vol
        $vol = new Vol();
        
        // Création du modèle du formulaire qui est lié à l'entité vol
        $model = $this->get('form.factory')->create(new VolModel(), $vol);
        
        // Obtention de l'objet "request"
        $request = $this->get('request');
        // Si l'utilisateur soumet le formulaire
        if ($request->getMethod() == 'POST')
        {
            // Attachement du modèle à l'objet "request"
            $model->bindRequest($request);
            if ($model->isValid())
            {
                // Obtention du manager
                $manager = $this->getManager();
                // Validation de l'entité
                $manager->saveVol($vol);
                
                // Redirection vers la page des vols
                return new RedirectResponse($this->generateUrl('admin_vol_index', 
                        array('id' => $vol->getVolId())));

            }
        }
        
        // On n'utilise pas le template par défaut mais le template de l'action 'edit'
        return $this->render('DevAeroportBundle:Admin/Vol:edit.html.twig', 
                array('form' => $model->createView(), 'vol' => $vol));
    }
    
    
    
    /**
     * @Route("/admin/vol/edit/{id}", name="admin_vol_edit")
     * @Template()
     */
    public function editAction($id)
    {
        
         // Obtention du manager
        $manager = $this->getManager();
        // Recherche de la vol
        if (!$vol = $manager->loadVol($id))
        {
            throw new NotFoundHttpException("La vol n'existe pas");
        }

        // Création du modèle du formulaire qui est lié à l'entité vol
        $model = $this->get('form.factory')->create(new VolModel(), $vol);

        // Obtention de l'objet "request"
        $request = $this->get('request');
        // Si l'utilisateur soumet le formulaire
        if ($request->getMethod() == 'POST')
        {
            // Attachement du modèle à l'objet "request"
            $model->bindRequest($request);
            if ($model->isValid())
            {
                // Validation de l'entité
                $manager->saveVol($vol);
                
                // Redirection vers la page des vols
                return new RedirectResponse($this->generateUrl('admin_vol_index', 
                        array('id' => $vol->getVolId())));
                
            }
        }
        
        
        // Redirection vers la page de modification d'une vol
        // return new RedirectResponse($this->generateUrl('admin_vol_home'));
        
        
        return array('form' => $model->createView(), 'vol' => $vol);
    }
    
    
    
    /**
     * @Route("/admin/vol/delete", name="admin_vol_delete")
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
            
            // Recherche du vol
            if (!$vol = $manager->loadVol($id))
            {
                throw new NotFoundHttpException("La vol n'existe pas");
            }

            $message = sprintf("Le vol num %u a ete supprime", $id);
            $status = 0;
            // Suppression de la vol
            try
            {
                $manager->removeVol($vol);
            }
            catch (Exception $e)
            {
                $message = sprintf("L erreur suivante est survenue lors de la suppression de la vol num %u : %s",
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
    
    
    
    
    
    /**
     * @Route("/admin/vol/reservations/{id}", name="admin_vol_reservations")
     * @Template()
     */
    public function reservationsAction($id)
    {
        
        // Obtention du manager et de la liste des clients qui ont réservé le vol passé en paramètre
        $clients = $this->getManager()->loadReservationsVol($id);
        
        return array('arrayClients' => $clients);
    }
    
    
    
    
    
    
    
    
    
}
