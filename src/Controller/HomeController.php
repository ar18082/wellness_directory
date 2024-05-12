<?php

namespace App\Controller;

use App\Entity\CategorieDeServices;
use App\Entity\Images;

use App\Entity\Utilisateur;
use App\Form\RechercheType;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;


class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(Request $request, EntityManagerInterface $entityManager): Response
    {
        
       

        
        // Création et Gestion du formulaire de recherche
        $form = $this->createForm(RechercheType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $datas = $form->getData();
            return $this->redirectToRoute('resultSearch');
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

        $user = $this->getUser();

        $icone = '';
        if(!empty($user)){
           
            if($user->getRoles()[0]=="PRE"){
                $imageIcone = $repositoryImage->findOneBy(['prestataire' => $user->getPrestataire()->getId() ]);
                
               
            }elseif($user->getRoles()[0]=="INT"){
                $imageIcone = $repositoryImage->findOneBy(['internaute' => $user->getInternaute()->getId()]);
            }

            if($imageIcone == null){
                $icone = '';
            }else{
                $icone = $imageIcone->getImage();
            }
                
            
            
        }

       

       

        $sliders= $repositoryImage->findBy([
            'prestataire' => null,
            'categorieDeServices' => NULL,
            'internaute' => null, 
        ]);

    
      
      

        return $this->render('home/index.html.twig', [
            'title' => 'Page d\'acceuil',
            'form' =>$form ->createView(),
            'categorieDeServices' => $categorieDeServices, // toutes les catégories de service present dans la sidebar
            'serviceDuMois' => $serviceDuMois, // services mis en avant pour 1 mois
            'utilisateurs' => $utilisateurs,// 4 derniers prestataires inscrit
            'images' => $images,
            'image_serviceDuMois' =>$image_serviceDuMois,
            'sliders' => $sliders,
            'icone' =>$icone,

        ]);
    }
}
