<?php

namespace App\Controller;

use App\Entity\CategorieDeServices;
use App\Entity\Images;
use App\Entity\Prestataire;
use App\Entity\Utilisateur;
use App\Entity\VilleCodePost;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Filesystem\Filesystem;
use Doctrine\ORM\Tools\Pagination\Paginator;


class SearchController extends AbstractController
{
    #[Route('/search', name: 'app_search')]
    public function index(Request $request, EntityManagerInterface $entityManager): Response
    {

        $repository = $entityManager->getRepository(Prestataire::class);
        $data = 'test';

       
        
           

        return new JsonResponse($data, JsonResponse::HTTP_OK);
    }

    #[Route('/prestataireAjax', name: 'prestataireAjax', methods:['GET'])]
    public function prestataireAjax(Request $request, EntityManagerInterface $entityManager): JsonResponse
    {
        $data = [];

        if ($request->query->has('q')) {
            $search = $request->query->get('q');
            $repository = $entityManager->getRepository(Prestataire::class);

            
            $queryBuilder = $repository->createQueryBuilder('p');
            
                    $queryBuilder->andWhere('p.nom LIKE :word')
                        ->setParameter('word', '%' . $search . '%');
            
                $prestataires = $queryBuilder->getQuery()->getResult();

                foreach ($prestataires as $prestataire) {
                    $data[] = [
                        'id' => $prestataire->getId(),
                        'nom' => $prestataire->getNom(),
                        // Ajoutez d'autres propriétés si nécessaire
                    ];
                }
        }
        
      

        
        return new JsonResponse($data);
    }

    #[Route('/Region-ville-CodePostal', name: 'Region-ville-CodePostalAjax', methods:['GET'])]
    public function RegionVilleCodePostalAjax(Request $request, EntityManagerInterface $entityManager, Filesystem $filesystem): JsonResponse
    {
        $data = [];

        if ($request->query->has('q')) {
            $search = $request->query->get('q');
            $repository = $entityManager->getRepository(VilleCodePost::class);
            $queryBuilder = $repository->createQueryBuilder('v');
            
            if (is_numeric($search)) {
               
                $queryBuilder->andWhere('v.CodePost = :CodePost')
                             ->setParameter('CodePost', $search);

                $VilleCodePosts = $queryBuilder->getQuery()->getResult();
        
                foreach ($VilleCodePosts as $VilleCodePost) {
                    $data[] = [
                        'id' => $VilleCodePost->getId(),
                        'CodePost' => $VilleCodePost->getCodePost(),
                        'ville' => $VilleCodePost->getVille(),
                        
                    ];
                }
            } else {
                
                $queryBuilder->andWhere('v.ville LIKE :word')
                             ->setParameter('word', '%' . $search . '%');

                $VilleCodePosts = $queryBuilder->getQuery()->getResult();
        
                foreach ($VilleCodePosts as $VilleCodePost) {
                    $data[] = [
                        'id' => $VilleCodePost->getId(),
                        'CodePost' => $VilleCodePost->getCodePost(),
                        'ville' => $VilleCodePost->getVille(),
                        
                    ];
                }
            }
            
            
        }
        
        
        return new JsonResponse($data);
    }

    #[Route('/categorieDeServicesAjax', name: 'categorieDeServicesAjax', methods:['GET'])]
    public function categorieDeServicesAjax(Request $request, EntityManagerInterface $entityManager): JsonResponse
    {
        $data = [];

        if ($request->query->has('q')) {
            $search = $request->query->get('q');
            $repository = $entityManager->getRepository(CategorieDeServices::class);

            
            $queryBuilder = $repository->createQueryBuilder('p');
            
                    $queryBuilder->andWhere('p.nom LIKE :word')
                        ->setParameter('word', '%' . $search . '%')
                        ->andWhere('p.Valide = :valid')
                        ->setParameter('valid', 1);
            
                $services = $queryBuilder->getQuery()->getResult();

                foreach ($services as $service) {
                    $data[] = [
                        'id' => $service->getId(),
                        'nom' => $service->getNom(),
                        
                    ];
                }
        }
        
        return new JsonResponse($data);
    }
       
    #[Route('/ResultSearchAjax', name: 'ResultSearchAjax', methods:['POST'])]
    public function ResultSearchAjax(Request $request, EntityManagerInterface $entityManager): JsonResponse
    {
         
        $jsonData = json_decode($request->getContent(), true);

      
        $prestataireId = $jsonData['prestataire'];
        $categorieDeServicesId = $jsonData['categorieDeServices'];

        $repository = $entityManager->getRepository(Prestataire::class);
        $prestataire = $repository->findOneBy(['id' => $prestataireId]);

        
        if (!$prestataire) {
            return new JsonResponse(['error' => 'Prestataire non trouvé'], 404);
        }

        
        $categories = $prestataire->getCategorieDeServices();

       
        $repositoryUser = $entityManager->getRepository(Utilisateur::class);
        $user = $repositoryUser->findOneBy(['prestataire_id'=>$prestataireId]);
        $VilleCodePost = $user->getVilleCodePost();

       
        $data = [];
        foreach ($categories as $categorie) {
            if($categorie->getId() == $categorieDeServicesId){
                $data[] = [
                    'id' => $categorie->getId(),
                    'nom' => $categorie->getNom(),
                  
                ];
            }
            
        }

        return new JsonResponse($data);
    }

    #[Route('/resultSearch', name: 'resultSearch')]
    public function resultSearch(Request $request, EntityManagerInterface $entityManager): Response
    {
        $selectPrestataire = $request->query->get('select_prestataire');
        $selectCategorieDeServices = $request->query->get('select_categorieDeServices');
        $selectVilleCPRegion = $request->query->get('select_ville_CP_region');

        

        $repository = $entityManager->getRepository(Prestataire::class)->createQueryBuilder('p');
        
        
        
        if (!empty($selectPrestataire)) {
            
            $query = $repository->find($selectPrestataire);
           
        } elseif (!empty($selectCategorieDeServices)){
            $query = $repository->leftJoin('p.CategorieDeServices', 'c')
            ->andWhere('c.id = :categorieId')
            ->setParameter('categorieId', $selectCategorieDeServices)
            ->getQuery();
        }elseif (!empty($selectVilleCPRegion)) {
          
            $repositoryUtilisateur = $entityManager->getRepository(Utilisateur::class);        
            $queryBuilder = $repositoryUtilisateur->createQueryBuilder('u')
                ->join('u.prestataire', 'p') // Supposons que l'association entre Utilisateur et Prestataire s'appelle "prestataire"
                ->where('u.VilleCodePost = :villeCodePost')
                ->andWhere('u.roles LIKE :roles')
                ->setParameter('villeCodePost', $selectVilleCPRegion)
                ->setParameter('roles', 'PRE');

            $query = $queryBuilder->getQuery();

            // Récupération des Utilisateurs filtrés
            $utilisateurs = $query->getResult();

            $prestatairesPagines = [];

            // Paginer les résultats et récupérer les prestataires associés
            foreach ($utilisateurs as $utilisateur) {
                $prestataire = $utilisateur->getPrestataire();
                if ($prestataire) {
                    $prestatairesPagines[] = $prestataire;
                }
            }
                    
        }else {
            $repository = $entityManager->getRepository(Prestataire::class);
            $query = $repository->findAll();

           
        }
        
        $paginator = new Paginator($query);
        $paginator->getQuery()->setFirstResult(0)->setMaxResults(10); 

        
        $prestataires = $paginator->getIterator()->getArrayCopy();
  
       
        $images = [];
        foreach ($prestataires as $prestataire) {
            $image = $entityManager->getRepository(Images::class)->findOneBy(['prestataire' => $prestataire->getId()]);
            if ($image) {
                $images[] = $image;
            }
        }
       

        return $this->render('search/index.html.twig', [
            'prestataires' => $prestataires,
            'images' =>$images,
            'controller_name' => 'resultSearch',
        ]);
    
    }
       
       
}
