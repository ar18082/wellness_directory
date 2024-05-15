<?php

namespace App\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Images;
use App\Entity\Utilisateur;
use App\Entity\Promotion;
use App\Entity\Stage;
use App\Entity\CategorieDeServices;

class DashBoardController extends AbstractController
{
    #[Route('/tableau_de_bord', name: 'app_dashboard')]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $user = $this->getUser();
       $id = $user->getPrestataire()->getId();
        
        $repositoryImage = $entityManager->getRepository(Images::class);
        $repositoryUtilisateur = $entityManager->getRepository(Utilisateur::class);
        $repositoryCategorieDeServices = $entityManager->getRepository(CategorieDeServices::class);
        $repositoryPromotion = $entityManager->getRepository(Promotion::class);
        $repositoryStage = $entityManager->getRepository(Stage::class);

        $stages = $repositoryStage->findBy(['prestataire' => $id]);
        $promotions = $repositoryPromotion->findBy(['prestataire' => $id]);
        $categorieDeServices = $repositoryCategorieDeServices->findAll();    
          
       
        $image = $repositoryImage->findOneBy(['prestataire' => $id]);
        $images = $repositoryImage->findByPrestataireNotNull();


        $icone = '';
        if(!empty($user)){
           
            if($user->getRoles()[0]=="PRE"){
                $imageIcone = $entityManager->getRepository(Images::class)->findOneBy(['prestataire' => $id ]);
                
               
            }elseif($user->getRoles()[0]=="INT"){
                $imageIcone = $entityManager->getRepository(Images::class)->findOneBy(['internaute' => $id]);
            }

            if($imageIcone == null){
                $icone = '';
            }else{
                $icone = $imageIcone->getImage();
            }
        }

      





    
      // dd($stages);

        return $this->render('dash_board/index.html.twig', [
            'controller_name' => 'Tableau de bord : Bonjour '. $user->getprestataire()->getNom(),
            'utilisateur' => $user,
            'categorieDeServices' => $categorieDeServices,
            'image' => $image,
            'icone' => $icone, 
            'stages' => $stages,
            'promotions' => $promotions,
        ]);
    }

   

        
        
    
}
