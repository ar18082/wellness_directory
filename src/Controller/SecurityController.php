<?php

namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\HttpFoundation\Request;

use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class SecurityController extends AbstractController
{

    private $router;

    public function __construct(RouterInterface $router)
    {
        $this->router = $router;
    }

    #[Route(path: '/connexion', name: 'app_login')]
    public function login(Request $request, AuthenticationUtils $authenticationUtils): Response
    {
       
        // get the login error if there is one
         //if ($this->getUser()) {
          // return $this->redirectToRoute('app_home');
       // }

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        if(!empty($error)){
           // dd($error->setMessage(''));
        }
       
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

       //dd($lastUsername, $error);
        return $this->render('security/login.html.twig', [
            'last_username' => $lastUsername, 
            'error' => $error,
            
        ]);
    }

    #[Route(path: '/logout', name: 'app_logout')]
    public function logout()
    {
        $logoutUrl = $this->router->generate('app_home');

        return new RedirectResponse($logoutUrl);

    }
}
