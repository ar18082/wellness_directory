<?php

namespace App\Controller;

use App\Entity\CategorieDeServices;
use App\Entity\Images;
use App\Entity\Prestataire;
use App\Entity\Utilisateur;
use App\Form\RechercheType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;

class PrestataireController extends AbstractController
{
    #[Route('/prestataire/{id}', name: 'app_prestataire')]
    public function index($id, Request $request, EntityManagerInterface $entityManager): Response
    {
        $repository = $entityManager->getRepository(Utilisateur::class);
        $utilisateur = $repository->findOneBy(['id' => $id]);

        $repository = $entityManager->getRepository(CategorieDeServices::class);
        $categorieDeServices = $repository->findAll();

       $repositoryImage = $entityManager->getRepository(Images::class);
       $image = $repositoryImage->findOneBy(['prestataire' => $utilisateur->getPrestataire()->getId()]);
       $sliders= $repositoryImage->findBy([
        'prestataire' => null,
        'categorieDeServices' => NULL,
        'internaute' => null, 
    ]);

       $form = $this->createForm(RechercheType::class);
       $form->handleRequest($request);
       if ($form->isSubmitted() && $form->isValid()) {
           $datas = $form->getData();

           return $this->redirectToRoute('app_home');
       } 
    

       //récupérer les prestataires qui ont les memes catégories de services et qui sont la meme région. 
       

        return $this->render('prestataire/index.html.twig', [
            'controller_name' => 'Prestataire',
            'utilisateur' => $utilisateur,
            'categorieDeServices' => $categorieDeServices,
            'image' => $image,
            'form' =>$form ->createView(),
            'sliders' => $sliders
        ]);
    }

   

}
