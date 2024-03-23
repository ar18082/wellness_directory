<?php

namespace App\Controller;

use App\Entity\CategorieDeServices;
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
        
        return $this->render('categorie_de_services/index.html.twig', [
            'controller_name' => 'CategorieDeServicesController',
            'service' => $service, 
            'categorieDeServices' => $categorieDeServices,
        ]);
    }
}
