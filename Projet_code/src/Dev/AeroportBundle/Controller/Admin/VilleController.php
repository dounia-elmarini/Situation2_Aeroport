<?php

namespace Dev\AeroportBundle\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;

use Dev\AeroportBundle\Entity\Ville;
use Dev\AeroportBundle\Manager\VilleManager;
use Dev\AeroportBundle\Form\VilleModel;



class VilleController extends Controller
{
    
    
    private function getManager()
    {
        return new VilleManager($this->getDoctrine()->getEntityManager());
    }
    
    
    
    /**
     * @Route("/admin/ville", name="admin_ville_index")
     * @Template()
     */
    public function indexAction()
    {
        
        // Obtention du manager et de la liste des villes
        $villes = $this->getManager()->loadAllVilles();
        
        return array('arrayVilles' => $villes);
    }
    
    
    
    /**
     * @Route("/admin/ville/add", name="admin_ville_add")
     * @Template()
     */
    public function addAction()
    {
        
        // Création d'une nouvelle ville
        $ville = new Ville();
        
        // Création du modèle du formulaire qui est lié à l'entité ville
        $model = $this->get('form.factory')->create(new VilleModel(), $ville);
        
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
                $manager->saveVille($ville);
                
                // Redirection vers la page des villes
                return new RedirectResponse($this->generateUrl('admin_ville_index', 
                        array('id' => $ville->getVilleId())));

            }
        }
        
        // On n'utilise pas le template par défaut mais le template de l'action 'edit'
        return $this->render('DevAeroportBundle:Admin/Ville:edit.html.twig', 
                array('form' => $model->createView(), 'ville' => $ville));
    }
    
    
    
    /**
     * @Route("/admin/ville/edit/{id}", name="admin_ville_edit")
     * @Template()
     */
    public function editAction($id)
    {
        
         // Obtention du manager
        $manager = $this->getManager();
        // Recherche de la ville
        if (!$ville = $manager->loadVille($id))
        {
            throw new NotFoundHttpException("La ville n'existe pas");
        }

        // Création du modèle du formulaire qui est lié à l'entité ville
        $model = $this->get('form.factory')->create(new VilleModel(), $ville);

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
                $manager->saveVille($ville);
                
                // Redirection vers la page des villes
                return new RedirectResponse($this->generateUrl('admin_ville_index', 
                        array('id' => $ville->getVilleId())));
                
            }
        }
        
        
        // Redirection vers la page de modification d'une ville
        // return new RedirectResponse($this->generateUrl('admin_ville_home'));
        
        
        return array('form' => $model->createView(), 'ville' => $ville);
    }
    
    
    
    /**
     * @Route("/admin/ville/delete", name="admin_ville_delete")
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
            // Recherche de la ville
            if (!$ville = $manager->loadVille($id))
            {
                throw new NotFoundHttpException("La ville n'existe pas");
            }

            $message = sprintf("Le ville num %u a ete supprime", $id);
            $status = 0;
            // Suppression de la ville
            try
            {
                $manager->removeVille($ville);
            }
            catch (Exception $e)
            {
                $message = sprintf("L erreur suivante est survenue lors de la suppression de la ville num %u : %s",
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
