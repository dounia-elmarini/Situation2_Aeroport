<?php

namespace Dev\AeroportBundle\Controller\Security;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\Security\Core\SecurityContext;


class AuthenticationController extends Controller
{
    
    
    /**
     * @Route("/login", name="security_login")
     * @Template()
     */
    public function loginAction()
    {
        // Si le visiteur est déjà identifié, on le redirige vers l'accueil
        if ($this->get('security.context')->isGranted('IS_AUTHENTICATED_REMEMBERED'))
        {
          return $this->redirect($this->generateUrl('admin_vol_index'));
        }
        
        
        $request = $this->getRequest();
        $session = $request->getSession();

        // On vérifie s'il y a des erreurs d'une précédente soumission du formulaire
        if ($request->attributes->has(SecurityContext::AUTHENTICATION_ERROR))
        {
          $error = $request->attributes->get(SecurityContext::AUTHENTICATION_ERROR);
        }
        else
        {
          $error = $session->get(SecurityContext::AUTHENTICATION_ERROR);
          $session->remove(SecurityContext::AUTHENTICATION_ERROR);
        }
        return $this->render('DevAeroportBundle:Security/Authentication:adminlogin.html.twig', array('error' => $error));
         
         
    }
    
    /**
     * @Route("/logincheck", name="security_logincheck")
     * @Template()
     */
    public function loginCheckAction()
    {
    }
    
    /**
     * @Route("/logout", name="security_logout")
     * @Template()
     */
    public function logoutAction()
    {
        return $this->redirect($this->generateUrl('homepage'));
    }
    
    
    
    
    
    
    
}

?>
