<?php

namespace App\Controller;

use App\Entity\CategorieDeServices;
use App\Entity\Prestataire;
use App\Entity\Utilisateur;
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

       //dd($utilisateur);

        return $this->render('prestataire/index.html.twig', [
            'controller_name' => 'Prestataire',
            'utilisateur' => $utilisateur,
            'categorieDeServices' => $categorieDeServices,
        ]);
    }

   

}
