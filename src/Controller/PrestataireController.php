<?php

namespace App\Controller;

use App\Entity\CategorieDeServices;
use App\Entity\Images;
use App\Entity\Prestataire;
use App\Entity\Promotion;
use App\Entity\Stage;
use App\Entity\Utilisateur;
use App\Form\RechercheType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Doctrine\ORM\Tools\Pagination\Paginator;

class PrestataireController extends AbstractController
{
    #[Route('/prestataire/{id}', name: 'app_prestataire')]
    public function index($id, Request $request, EntityManagerInterface $entityManager): Response
    {
        $repositoryImage = $entityManager->getRepository(Images::class);
        $repositoryUtilisateur = $entityManager->getRepository(Utilisateur::class);
        $repositoryCategorieDeServices = $entityManager->getRepository(CategorieDeServices::class);
        $repositoryPromotion = $entityManager->getRepository(Promotion::class);
        $repositoryStage = $entityManager->getRepository(Stage::class);

        $stages = $repositoryStage->findOneBy(['prestataire_id' => $id]);
        $promotions = $repositoryPromotion->findOneBy(['prestataire_id' => $id]);
        

        $utilisateur = $repositoryUtilisateur->findOneBy(['id' => $id]);
        $presta= $utilisateur->getPrestataire();

        if ($presta !== null) {
            $repositoryPresta = $entityManager->getRepository(Prestataire::class);
            $categs = $presta->getCategorieDeServices();
            $categs->initialize();

           
        
            $prestatairesSimilaires = [];
        
            foreach ($categs as $categ) {
                
                $prestataires = $repositoryPresta->findByCategorieDeServices($categ);                
                $prestatairesSimilaires = array_merge($prestatairesSimilaires, $prestataires);
            }
        
            
        } else {
          
            echo "Prestataire non trouvé.";
        }
       
        $categorieDeServices = $repositoryCategorieDeServices->findAll();

       
        $image = $repositoryImage->findOneBy(['prestataire' => $utilisateur->getPrestataire()->getId()]);
        $images = $repositoryImage->findByPrestataireNotNull();

    
        $sliders= $repositoryImage->findBy([
            'prestataire' => null,
            'categorieDeServices' => NULL,
            'internaute' => null, 
        ]);

       

       

        $form = $this->createForm(RechercheType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $datas = $form->getData();

            return $this->redirectToRoute('resultSearch');
        } 


    

          $queryBuilder = $entityManager->createQueryBuilder()
            ->select('p')
            ->from('App\Entity\Prestataire', 'p');

        foreach ($categs as $categ) {
            $queryBuilder
                ->orWhere(':categ MEMBER OF p.CategorieDeServices')
                ->setParameter('categ', $categ);
        }

        $query = $queryBuilder->getQuery();

        // Pagination
        $page = $request->query->getInt('page', 1);
        $limit = 10; // Nombre de résultats par page

        $paginator = new Paginator($query);
        $paginator
            ->getQuery()
            ->setFirstResult(($page - 1) * $limit)
            ->setMaxResults($limit);

        $totalItems = count($paginator);

        $maxPage = ceil($totalItems / $limit);

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

        return $this->render('prestataire/index.html.twig', [
            'controller_name' => 'Prestataire',
            'utilisateur' => $utilisateur,
            'categorieDeServices' => $categorieDeServices,
            'image' => $image,
            'images' => $images,
            'form' =>$form ->createView(),
            'sliders' => $sliders,
            'prestatairesSimilaires' => $prestatairesSimilaires,
            'totalItems' => $totalItems,
            'maxPage' => $maxPage,
            'currentPage' => $page,
            'icone' => $icone
        ]);
    }

   

}
