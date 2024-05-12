<?php

namespace App\Controller;

use App\Entity\CategorieDeServices;
use App\Entity\Images;
use App\Entity\Prestataire;

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

        
        
        $images = [];
        foreach ($prestataires as $prestataire) {
            
            $images[]= $repositoryImage->findOneBy(['prestataire' => $prestataire->getId()]);
        }
       
      

        $form = $this->createForm(RechercheType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $datas = $form->getData();

            return $this->redirectToRoute('resultSearch');
        } 

        $user = $this->getUser();

        $icone = '';
        if(!empty($user)){
           
            if($user->getRoles()[0]=="PRE"){
                $imageIcone = $entityManager->getRepository(Images::class)->findOneBy(['prestataire' => $user->getPrestataire()->getId() ]);
                
               
            }elseif($user->getRoles()[0]=="INT"){
                $imageIcone = $entityManager->getRepository(Images::class)->findOneBy(['internaute' => $user->getInternaute()->getId()]);
            }

            if($imageIcone == null){
                $icone = '';
            }else{
                $icone = $imageIcone->getImage();
            }
        }
       
        
        return $this->render('categorie_de_services/index.html.twig', [
            'controller_name' => 'CategorieDeServicesController',
            'categ' => $service, 
            'categorieDeServices' => $categorieDeServices,
            'image' => $image,
            'form' =>$form ->createView(),
            'sliders' => $sliders,
            'prestataires' => $prestataires,
            'images' => $images,
            'icone' => $icone,
        ]);
    }
}
