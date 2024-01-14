<?php

namespace App\Controller;

use App\Entity\CategorieDeServices;
use App\Form\CategServiceType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;

class DevController extends AbstractController
{
    #[Route('/dev/addCategService', name: 'app_dev')]
    public function index(Request $request, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(CategServiceType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $datas = $form->getData();

            $categ = new CategorieDeServices;
            $categ->setNom($datas->getNom());
            $categ->setDescription($datas->getDescription());
            $entityManager->persist($categ);
            $entityManager->flush();

            return $this->redirectToRoute('app_dev');
        }

        

        return $this->render('dev/index.html.twig', [
            'controller_name' => 'DevController',
            'form' =>$form ->createView(),
        ]);
    }

    #[Route('/dev/modifCateg', name: 'app_modifCateg')]
    public function modifCateg(Request $request, EntityManagerInterface $entityManager): Response
    {

        $repository = $entityManager->getRepository(CategorieDeServices::class);
        $categorieDeServices = $repository->findAll();
        // choix d'un service mis en avant pour une durée d'un mois (choix du 1er du mois -> au dernier jour du mois !!! 30,31 ou 28!!!!!)
        
        foreach ($categorieDeServices as $categorieService) {
            $categorieService->setValide(true);
            // Enregistrez les modifications dans la base de données si nécessaire
            $entityManager->persist($categorieService);
        }
        
        $entityManager->flush();

        return $this->render('dev/modifCateg.html.twig', [
            'title' => 'DevController',
            
        ]);
    }

    #[Route('/dev/categNonValide', name: 'app_modifCateg')]
    public function categNonValide(Request $request, EntityManagerInterface $entityManager): Response
    {

        $repository = $entityManager->getRepository(CategorieDeServices::class);
        $service = $repository->findOneBy(['id' => 3 ]);
        // choix d'un service mis en avant pour une durée d'un mois (choix du 1er du mois -> au dernier jour du mois !!! 30,31 ou 28!!!!!)
        
        
            $service->setValide(false);
            // Enregistrez les modifications dans la base de données si nécessaire
            $entityManager->persist($service);
       
        
            $entityManager->flush();

        return $this->render('dev/modifCateg.html.twig', [
            'title' => 'DevController',
            
        ]);
    }
    #[Route('/dev', name: 'app_dev')]
    public function devConfirm(Request $request, EntityManagerInterface $entityManager): Response
    {

        
        return $this->render('dev/modifCateg.html.twig', [
            'title' => 'ok',
            
        ]);
    }
}
