<?php

namespace App\Controller;

use App\Entity\CategorieDeServices;
use App\Entity\Prestataire;
use App\Form\RechercheType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;

class HomeController extends AbstractController
{
    #[Route('/home', name: 'app_home')]
    public function index(Request $request, EntityManagerInterface $entityManager): Response
    {
        // Création et Gestion du formulaire de recherche
        $form = $this->createForm(RechercheType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $datas = $form->getData();
            return $this->redirectToRoute('app_home');
        }
        
        //récupération des catégories de services 
        /* 
            attention introduire un if valide == true
        */
        $repository = $entityManager->getRepository(CategorieDeServices::class);
        $categorieDeServices = $repository->findAll();
        // choix d'un service mis en avant pour une durée d'un mois (choix du 1er du mois -> au dernier jour du mois !!! 30,31 ou 28!!!!!)
        $serviceDuMois = $repository->findOneBy(['id' => 1 ]);

       
        // récupération des prestataires
        $repository = $entityManager->getRepository(Prestataire::class);
        $prestataires = $repository->findAll();
        // récupération des 4 prestataires récement inscrit 
       

        return $this->render('home/index.html.twig', [
            'title' => 'Page d\'acceuil',
            'form' =>$form ->createView(),
            'categorieDeServices' => $categorieDeServices,
            'serviceDuMois' => $serviceDuMois

        ]);
    }
}
