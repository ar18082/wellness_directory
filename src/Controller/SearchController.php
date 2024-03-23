<?php

namespace App\Controller;

use App\Entity\CategorieDeServices;
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
                // Recherche basée sur un ID numérique
                $queryBuilder->andWhere('v.CodePost = :CodePost')
                             ->setParameter('CodePost', $search);

                $VilleCodePosts = $queryBuilder->getQuery()->getResult();
        
                foreach ($VilleCodePosts as $VilleCodePost) {
                    $data[] = [
                        'id' => $VilleCodePost->getId(),
                        'CodePost' => $VilleCodePost->getCodePost(),
                        'ville' => $VilleCodePost->getVille(),
                        // Ajoutez d'autres propriétés si nécessaire
                    ];
                }
            } else {
                // Recherche basée sur une chaîne de caractères
                $queryBuilder->andWhere('v.ville LIKE :word')
                             ->setParameter('word', '%' . $search . '%');

                $VilleCodePosts = $queryBuilder->getQuery()->getResult();
        
                foreach ($VilleCodePosts as $VilleCodePost) {
                    $data[] = [
                        'id' => $VilleCodePost->getId(),
                        'CodePost' => $VilleCodePost->getCodePost(),
                        'ville' => $VilleCodePost->getVille(),
                        // Ajoutez d'autres propriétés si nécessaire
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
         // Récupérer les données JSON envoyées dans la requête
        $jsonData = json_decode($request->getContent(), true);

        // Extraire les données individuelles
        $prestataireId = $jsonData['prestataire'];
        $categorieDeServicesId = $jsonData['categorieDeServices'];

        $repository = $entityManager->getRepository(Prestataire::class);
        $prestataire = $repository->findOneBy(['id' => $prestataireId]);

        // Vérifiez si le prestataire existe
        if (!$prestataire) {
            return new JsonResponse(['error' => 'Prestataire non trouvé'], 404);
        }

        // Maintenant, vous pouvez accéder à la relation many-to-many pour obtenir les catégories de services associées
        $categories = $prestataire->getCategorieDeServices();

        dd($categories);
        $repositoryUser = $entityManager->getRepository(Utilisateur::class);
        $user = $repositoryUser->findOneBy(['prestataire_id'=>$prestataireId]);
        $VilleCodePost = $user->getVilleCodePost();

        // Construire la réponse JSON avec les données récupérées
        $data = [];
        foreach ($categories as $categorie) {
            if($categorie->getId() == $categorieDeServicesId){
                $data[] = [
                    'id' => $categorie->getId(),
                    'nom' => $categorie->getNom(),
                    // Ajoutez d'autres propriétés si nécessaire
                ];
            }
            
        }

        return new JsonResponse($data);
    }
       
       
}
