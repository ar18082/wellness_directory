<?php

namespace App\Controller;

use App\Entity\CategorieDeServices;
use App\Entity\Prestataire;
use App\Entity\Utilisateur;
use App\Form\RechercheType;
use App\Service\PrestataireRecent;
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


        // choix à faire dans le dashboard de l'admin
        // service du mois mis à l'honneur 
        $serviceDuMois = $repository->findOneBy(['EnAvant' => 1 ]);
        
       
        // récupération des prestataires
        /*
        dans prestataire repository créer une requete custom avec un joinleft d'utilisateur */
        $repository = $entityManager->getRepository(Utilisateur::class);
        $prestataires = $repository->FindPrestaRecent();
        
        //dd($prestataires[0]->getPrestataire()->getNom());

       
        
       

        return $this->render('home/index.html.twig', [
            'title' => 'Page d\'acceuil',
            'form' =>$form ->createView(),
            'categorieDeServices' => $categorieDeServices, // toutes les catégories de service present dans la sidebar
            'serviceDuMois' => $serviceDuMois, // services mis en avant pour 1 mois
            'prestataires' => $prestataires // 4 derniers prestataires inscrit

        ]);
    }
}
