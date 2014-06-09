<?php

namespace Dev\AeroportBundle\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;

use Dev\AeroportBundle\Entity\Avion;
use Dev\AeroportBundle\Manager\AvionManager;
use Dev\AeroportBundle\Form\AvionModel;



class AvionController extends Controller
{
    
    
    private function getManager()
    {
        return new AvionManager($this->getDoctrine()->getEntityManager());
    }
    
    
    
    /**
     * @Route("/admin/avion", name="admin_avion_index")
     * @Template()
     */
    public function indexAction()
    {
        
        // Obtention du manager et de la liste des avions
        $avions = $this->getManager()->loadAllAvions();
        
        return array('arrayAvions' => $avions);
    }
    
    
    
    /**
     * @Route("/admin/avion/add", name="admin_avion_add")
     * @Template()
     */
    public function addAction()
    {
        
        // Création d'une nouvelle avion
        $avion = new Avion();
        
        // Création du modèle du formulaire qui est lié à l'entité avion
        $model = $this->get('form.factory')->create(new AvionModel(), $avion);
        
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
                $manager->saveAvion($avion);
                
                // Redirection vers la page des avions
                return new RedirectResponse($this->generateUrl('admin_avion_index', 
                        array('id' => $avion->getAvionId())));

            }
        }
        
        // On n'utilise pas le template par défaut mais le template de l'action 'edit'
        return $this->render('DevAeroportBundle:Admin/Avion:edit.html.twig', 
                array('form' => $model->createView(), 'avion' => $avion));
    }
    
    
    
    /**
     * @Route("/admin/avion/edit/{id}", name="admin_avion_edit")
     * @Template()
     */
    public function editAction($id)
    {
        
         // Obtention du manager
        $manager = $this->getManager();
        // Recherche de la avion
        if (!$avion = $manager->loadAvion($id))
        {
            throw new NotFoundHttpException("La avion n'existe pas");
        }

        // Création du modèle du formulaire qui est lié à l'entité avion
        $model = $this->get('form.factory')->create(new AvionModel(), $avion);

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
                $manager->saveAvion($avion);
                
                // Redirection vers la page des avions
                return new RedirectResponse($this->generateUrl('admin_avion_index', 
                        array('id' => $avion->getAvionId())));
                
            }
        }
        
        
        // Redirection vers la page de modification d'une avion
        // return new RedirectResponse($this->generateUrl('admin_avion_home'));
        
        
        return array('form' => $model->createView(), 'avion' => $avion);
    }
    
    
    
    /**
     * @Route("/admin/avion/delete", name="admin_avion_delete")
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
            // Recherche de la avion
            if (!$avion = $manager->loadAvion($id))
            {
                throw new NotFoundHttpException("La avion n'existe pas");
            }

            $message = sprintf("Le avion num %u a ete supprime", $id);
            $status = 0;
            // Suppression de la avion
            try
            {
                $manager->removeAvion($avion);
            }
            catch (Exception $e)
            {
                $message = sprintf("L erreur suivante est survenue lors de la suppression de la avion num %u : %s",
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
