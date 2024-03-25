<?php

namespace App\Controller;

use App\Entity\CategorieDeServices;
use App\Entity\Images;
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
        
        $repositoryImage = $entityManager->getRepository(Images::class);
        //récupération des catégories de services 
        $repository = $entityManager->getRepository(CategorieDeServices::class);
        $categorieDeServices = $repository->findBy(['Valide' => true]);

        // choix à faire dans le dashboard de l'admin
        // service du mois mis à l'honneur + image 
        $serviceDuMois = $repository->findOneBy(['EnAvant' => 1 ]);
        $image_serviceDuMois = $repositoryImage->findOneBy(['categorieDeServices'=> $serviceDuMois->getId()]);
        
        
        // récupération des prestataires les plus récent + images
        $repository = $entityManager->getRepository(Utilisateur::class);
        $utilisateurs = $repository->FindPrestaRecent();
        $images = [];
        foreach ($utilisateurs as $utilisateur) {
            $images[]= $repositoryImage->findOneBy(['prestataire' => $utilisateur->getPrestataire()->getId()]);
        }

       

        $sliders= $repositoryImage->findBy([
            'prestataire' => null,
            'categorieDeServices' => NULL,
            'internaute' => null, 
        ]);

    
      
        //dd($sliders);
       

        return $this->render('home/index.html.twig', [
            'title' => 'Page d\'acceuil',
            'form' =>$form ->createView(),
            'categorieDeServices' => $categorieDeServices, // toutes les catégories de service present dans la sidebar
            'serviceDuMois' => $serviceDuMois, // services mis en avant pour 1 mois
            'utilisateurs' => $utilisateurs,// 4 derniers prestataires inscrit
            'images' => $images,
            'image_serviceDuMois' =>$image_serviceDuMois,
            'sliders' => $sliders

        ]);
    }
}
