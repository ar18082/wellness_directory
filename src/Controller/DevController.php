<?php

namespace App\Controller;

use App\Entity\CategorieDeServices;
use App\Entity\Region;
use App\Entity\VilleCodePost;
use App\Form\CategServiceType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Filesystem\Filesystem;

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
       
        foreach ($categorieDeServices as $categorieService) {
            $categorieService->setValide(true);
           
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
       
        
            $service->setValide(false);
            
            $entityManager->persist($service);
       
        
            $entityManager->flush();

        return $this->render('dev/modifCateg.html.twig', [
            'title' => 'DevController',
            
        ]);
    }
    #[Route('/dev', name: 'app_dev')]
    public function devConfirm(Request $request, EntityManagerInterface $entityManager): Response
    {

        
        return $this->render('error/error_404.html.twig', [
            
            
        ]);
    }

    #[Route('/dev/villeCodePost', name: 'villeCodePost')]
    public function villeCodePost(Request $request, EntityManagerInterface $entityManager, Filesystem $filesystem): Response
    {
        $filePath = $this->getParameter('kernel.project_dir') . '/public/json/Region-ville-CodePostal.json';

            // Lire le contenu du fichier JSON
            $jsonContent = file_get_contents($filePath);
            $jsonData = json_decode($jsonContent, true);

           // Récupérer le repository de l'entité VilleCodePost
            $repository = $entityManager->getRepository(VilleCodePost::class);

        // Boucler sur les données du JSON
        foreach ($jsonData as $data) {
           
            // Vérifier si les données existent déjà en base de données
            $existingVilleCodePost = $repository->findOneBy([
                'ville' => $data['ville'],
                'CodePost' => $data['codePostal']
            ]);

          

            // Si les données n'existent pas déjà, créer un nouvel objet VilleCodePost
            if (!$existingVilleCodePost) {
                $villeCodePost = new VilleCodePost();
                $villeCodePost->setVille($data['ville']);
                $villeCodePost->setCodePost ($data['codePostal']);

                // Enregistrer l'objet dans la base de données
                $entityManager->persist($villeCodePost);
                $entityManager->flush();
            }
        }

       
        
        return $this->render('error/error_404.html.twig', [
            
            
        ]);
    }

    #[Route('/dev/region', name: 'region')]
    public function region(Request $request, EntityManagerInterface $entityManager, Filesystem $filesystem): Response
    {
        $filePath = $this->getParameter('kernel.project_dir') . '/public/json/Region-ville-CodePostal.json';
    
        // Lire le contenu du fichier JSON
        $jsonContent = file_get_contents($filePath);
        $jsonData = json_decode($jsonContent, true);
    
        // Récupérer le repository de l'entité Region
        $repository = $entityManager->getRepository(Region::class);
        // Récupérer le repository de l'entité VilleCodePost
        $villeCodePostRepository = $entityManager->getRepository(VilleCodePost::class);
    
        // Boucler sur les données du JSON
        foreach ($jsonData as $data) {
            // Vérifier si les données existent déjà en base de données
            $existingRegion = $repository->findOneBy([
                'region' => $data['region'],
            ]);
    
            if (!$existingRegion) {
                // Créer un nouvel objet Region
                $region = new Region();
                $region->setRegion($data['region']);
    
                // Enregistrer l'objet dans la base de données
                $entityManager->persist($region);
                $entityManager->flush();
            } else {
                // Si la région existe déjà, utilisez-la directement
                $region = $existingRegion;
            }
    
            // Récupérer le code postal correspondant
            $villeCodePost = $villeCodePostRepository->findOneBy([
                'CodePost' => $data['codePostal']
            ]);
    
            if ($villeCodePost) {
                // Assigner la région au code postal trouvé
                $villeCodePost->setRegion($region);
                $entityManager->persist($villeCodePost);
                $entityManager->flush();
            }
        }
    
        return $this->render('error/error_404.html.twig', [
            // Vous pouvez ajouter des variables à envoyer au template si nécessaire
        ]);
    }

    #[Route('/test', name: 'test')]
    public function test(Request $request, EntityManagerInterface $entityManager, Filesystem $filesystem): Response
    {
        $this->getUser();

        
        return $this->render('dev/test.html.twig', [
            
        ]);
    }
}
