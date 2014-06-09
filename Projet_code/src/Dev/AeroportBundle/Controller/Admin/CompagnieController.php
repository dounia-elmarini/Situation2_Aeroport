<?php

namespace Dev\AeroportBundle\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;

use Dev\AeroportBundle\Entity\Compagnie;
use Dev\AeroportBundle\Manager\CompagnieManager;
use Dev\AeroportBundle\Form\CompagnieModel;



class CompagnieController extends Controller
{
    
    
    private function getManager()
    {
        return new CompagnieManager($this->getDoctrine()->getEntityManager());
    }
    
    
    
    /**
     * @Route("/admin/compagnie", name="admin_compagnie_index")
     * @Template()
     */
    public function indexAction()
    {
        
        // Obtention du manager et de la liste des compagnies
        $compagnies = $this->getManager()->loadAllCompagnies();
        
        return array('arrayCompagnies' => $compagnies);
    }
    
    
    
    /**
     * @Route("/admin/compagnie/add", name="admin_compagnie_add")
     * @Template()
     */
    public function addAction()
    {
        
        // Création d'une nouvelle compagnie
        $compagnie = new Compagnie();
        
        // Création du modèle du formulaire qui est lié à l'entité compagnie
        $model = $this->get('form.factory')->create(new CompagnieModel(), $compagnie);
        
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
                $manager->saveCompagnie($compagnie);
                
                // Redirection vers la page des compagnies
                return new RedirectResponse($this->generateUrl('admin_compagnie_index', 
                        array('id' => $compagnie->getCompagnieId())));

            }
        }
        
        // On n'utilise pas le template par défaut mais le template de l'action 'edit'
        return $this->render('DevAeroportBundle:Admin/Compagnie:edit.html.twig', 
                array('form' => $model->createView(), 'compagnie' => $compagnie));
    }
    
    
    
    /**
     * @Route("/admin/compagnie/edit/{id}", name="admin_compagnie_edit")
     * @Template()
     */
    public function editAction($id)
    {
        
         // Obtention du manager
        $manager = $this->getManager();
        // Recherche de la compagnie
        if (!$compagnie = $manager->loadCompagnie($id))
        {
            throw new NotFoundHttpException("La compagnie n'existe pas");
        }

        // Création du modèle du formulaire qui est lié à l'entité compagnie
        $model = $this->get('form.factory')->create(new CompagnieModel(), $compagnie);

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
                $manager->saveCompagnie($compagnie);
                
                // Redirection vers la page des compagnies
                return new RedirectResponse($this->generateUrl('admin_compagnie_index', 
                        array('id' => $compagnie->getCompagnieId())));
                
            }
        }
        
        
        // Redirection vers la page de modification d'une compagnie
        // return new RedirectResponse($this->generateUrl('admin_compagnie_home'));
        
        
        return array('form' => $model->createView(), 'compagnie' => $compagnie);
    }
    
    
    
    /**
     * @Route("/admin/compagnie/delete", name="admin_compagnie_delete")
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
            // Recherche de la compagnie
            if (!$compagnie = $manager->loadCompagnie($id))
            {
                throw new NotFoundHttpException("La compagnie n'existe pas");
            }

            $message = sprintf("Le compagnie num %u a ete supprime", $id);
            $status = 0;
            // Suppression de la compagnie
            try
            {
                $manager->removeCompagnie($compagnie);
            }
            catch (Exception $e)
            {
                $message = sprintf("L erreur suivante est survenue lors de la suppression de la compagnie num %u : %s",
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
