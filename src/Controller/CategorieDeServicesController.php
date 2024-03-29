<?php

namespace App\Controller;

use App\Entity\CategorieDeServices;
use App\Entity\Images;
use App\Entity\Prestataire;
use App\Entity\Utilisateur;
use App\Form\RechercheType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CategorieDeServicesController extends AbstractController
{
    #[Route('/categorie/de/services/{id}', name: 'app_categorie_de_services')]
    public function index($id, Request $request, EntityManagerInterface $entityManager): Response
    {
        $repository = $entityManager->getRepository(CategorieDeServices::class);
        $service = $repository->findOneBy(['id' => $id ]);
        $categorieDeServices =$repository->findAll();
        $repositoryImage = $entityManager->getRepository(Images::class);
        $image = $repositoryImage->findOneBy(['categorieDeServices'=>$id]);
        $sliders= $repositoryImage->findBy([
            'prestataire' => null,
            'categorieDeServices' => NULL,
            'internaute' => null, 
        ]);

        $repositoryPrestataire = $entityManager->getRepository(Prestataire::class);
        $prestataires = $repositoryPrestataire->findByCategorieDeServicesId($id);

        //$userRepository = $entityManager->getRepository(Utilisateur::class);
        
        $images = [];
        foreach ($prestataires as $prestataire) {
            //$utilisateur = $userRepository->find( $prestataire->getId());
            $images[]= $repositoryImage->findOneBy(['prestataire' => $prestataire->getId()]);
        }
       // <img src="{{ asset('votre_chemin_vers_l_image/' ~ prestataire.image) }}" class="card-img-top" alt="...">
        //dd($prestataires);
      

        $form = $this->createForm(RechercheType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $datas = $form->getData();

            return $this->redirectToRoute('app_home');
        } 

       //dd($image);
        
        return $this->render('categorie_de_services/index.html.twig', [
            'controller_name' => 'CategorieDeServicesController',
            'categ' => $service, 
            'categorieDeServices' => $categorieDeServices,
            'image' => $image,
            'form' =>$form ->createView(),
            'sliders' => $sliders,
            'prestataires' => $prestataires,
            'images' => $images
        ]);
    }
}
