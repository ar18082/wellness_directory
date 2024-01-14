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

    #[Route(path: '/login', name: 'app_login')]
    public function login(Request $request, AuthenticationUtils $authenticationUtils): Response
    {
       
        // get the login error if there is one
         //if ($this->getUser()) {
        //return $this->redirectToRoute('target_path');
        //}

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('registration/login.html.twig', [
            'last_username' => $lastUsername, 
            'error' => $error,
            
        ]);
    }

    #[Route(path: '/logout', name: 'app_logout')]
    public function logout()
    {
        $logoutUrl = $this->router->generate('app_logout');

        return new RedirectResponse($logoutUrl);

    }
}
