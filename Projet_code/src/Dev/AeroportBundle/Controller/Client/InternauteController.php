<?php

namespace Dev\AeroportBundle\Controller\Client;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;

use Dev\AeroportBundle\Entity\Internaute;
use Dev\AeroportBundle\Manager\InternauteManager;
use Dev\AeroportBundle\Form\InternauteModel;



class InternauteController extends Controller
{
    
    
    private function getManager()
    {
        return new InternauteManager($this->getDoctrine()->getEntityManager());
    }
    
    
    
    
    
    
    /**
     * @Route("/compte/creer", name="client_creer_compte")
     * @Template()
     */
    public function addAction()
    {
        
        // Cr�ation d'un nouveau compte internaute
        $internaute = new Internaute();
        
        // Cr�ation du mod�le du formulaire qui est li� � l'entit� internaute
        $model = $this->get('form.factory')->create(new InternauteModel(), $internaute);
        
        // Obtention de l'objet "request"
        $request = $this->get('request');
        // Si l'utilisateur soumet le formulaire
        if ($request->getMethod() == 'POST')
        {
            // Attachement du mod�le � l'objet "request"
            $model->bindRequest($request);
            if ($model->isValid())
            {
                // Obtention du manager
                $manager = $this->getManager();
                
                // D�finition du r�le
                $internaute->setRoles("ROLE_USER");
                
                // Validation de l'entit�
                $manager->saveInternaute($internaute);
                
                // Redirection
                return new RedirectResponse($this->generateUrl('client_reservation_mesreservations'));

            }
        }
        
        // On n'utilise pas le template par d�faut mais le template de l'action 'edit'
        return $this->render('DevAeroportBundle:Client/Internaute:edit.html.twig', 
                array('form' => $model->createView(), 'internaute' => $internaute));
    }
    
    
    
    /**
     * @Route("/client/compte/edit", name="client_modifier_compte")
     * @Template()
     */
    public function editAction($id)
    {
        
         // Obtention du manager
        $manager = $this->getManager();
        // Recherche de la internaute
        if (!$internaute = $manager->loadInternaute($id))
        {
            throw new NotFoundHttpException("La internaute n'existe pas");
        }

        // Cr�ation du mod�le du formulaire qui est li� � l'entit� internaute
        $model = $this->get('form.factory')->create(new InternauteModel(), $internaute);

        // Obtention de l'objet "request"
        $request = $this->get('request');
        // Si l'utilisateur soumet le formulaire
        if ($request->getMethod() == 'POST')
        {
            // Attachement du mod�le � l'objet "request"
            $model->bindRequest($request);
            if ($model->isValid())
            {
                // Validation de l'entit�
                $manager->saveInternaute($internaute);
                
                // Redirection
                return new RedirectResponse($this->generateUrl('client_reservation_mesreservations', 
                        array('id' => $internaute->getId())));
                
            }
        }
        
        
        // Redirection vers la page de modification d'une internaute
        // return new RedirectResponse($this->generateUrl('admin_internaute_home'));
        
        
        return array('form' => $model->createView(), 'internaute' => $internaute);
    }
    
    
    
    
    
}
