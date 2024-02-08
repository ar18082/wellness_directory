<?php

namespace App\Controller;

use App\Form\RoleType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Prestataire;
use App\Entity\Stage;
use App\Entity\Promotion;
use App\Entity\Internaute;
use Doctrine\ORM\EntityManagerInterface;

class InscriptionController extends AbstractController
{
    #[Route('/inscription', name: 'app_inscription')]
    public function index(): Response
    {
        
        return $this->render('inscription/index.html.twig', [
            'controller_name' => 'test',
           
        ]);
    }

    #[Route('/inscription/json', name: 'inscription_json', methods:['POST'])]
    public function formulaire_inscription(Request $request, EntityManagerInterface $entityManager)
    {
        $data = $request->toArray();

        //var_dump($data);

        return $this->redirectToRoute('app_inscription');
            
           
       
       // dd($data);

       // return new JsonResponse('success');
      
        /*$role = $data['role'];
        $fileData = $data['file'];

        if ($role == 'PRE') {
            $prestataireData = $data['prestataire'];
            $stageData = $data['stage'];
            $promotionData = $data['promotion'];

            $prestataire = new Prestataire();
            $prestataire->setNom($prestataireData['nom']);
            $prestataire->setNumTva($prestataireData['tva']);
            $prestataire->setNumTel($prestataireData['telephone']);
            $prestataire->setSiteInternet($prestataireData['site']);

            $entityManager->persist($prestataire);

            $stage = new Stage();
            $stage->setNom($stageData['nom']);
            $stage->setDescription($stageData['description']);
            $stage->setTarif($stageData['tarif']);
            $stage->setDebut(new \DateTime($stageData['date_debut_stg'])); 
            $stage->setFin(new \DateTime($stageData['date_fin_stg'])); 

            $entityManager->persist($stage);

            $promotion = new Promotion();
            $promotion->setNom($promotionData['nom_promo']);
            $promotion->setDescription($promotionData['description_promo']);
            //.......

            $entityManager->persist($promotion);

        }elseif($role == 'INT'){
            $internauteData = $data['internaute'];

            
            $internaute = new Internaute();
            $internaute->setNom($internauteData['nom']);
            $internaute->setPrenom($internauteData['prenom']);
           
            $entityManager->persist($internaute);
        }else {
            // si c'est aucun des deux alors l'utilisateur souhaite supprimer son inscription. 
            
        }


        // traitement du file 
            /* lier avec internaute et ou avec le prestataire */


        //$entityManager->flush();*/
        //return $this->render('inscription/test.html.twig', []);
    
       // return $this->json(['success' => true]);
    }

    

    
}
/*
- recupérer l'id de l'utilisateur
- création des différents formulaire 
- module image : 
 $utilisateurForm = $this->createForm($formType, $utilisateur);
        $utilisateurForm->handleRequest($request);

        // On récupère l'instance image
        $image = Utils::getImage($user, $imagesRepository);

        $imagesForm = $this->createForm(ImagesFormType::class, $image);
        $imagesForm->handleRequest($request);

        // foreach ( $user->getPrestataire()->getImages() as $item ) {dd($item);} 
        // dd($user->getPrestataire()->getImages()->toArray()[0], $image);

        if ($userForm->isSubmitted() && $userForm->isValid() || $utilisateurForm->isSubmitted() && $utilisateurForm->isValid() || $imagesForm->isSubmitted() && $imagesForm->isValid()) {
            // On récupère l'image du form
            $image = $imagesForm->get('nom')->getData();

            if($image) {
                $folder = $user->getTypeUtilisateur();
                $id = $utilisateur->getId();
                
                $verif = $imagesRepository->findOneBy(['prestataire' => $id]);

                if($verif) {
                    $oldPicture = $verif->getNom();
                    $path = $parameterBagInterface->get('image_directory') . $folder . '/' . $oldPicture;
                    if (file_exists($path)) {
                        unlink($path);
                    }

                    $fichier = $pictureService->add($image, $folder);

                    $verif->setNom($fichier);
                    $utilisateur->addImage($verif);
                } else {
                    $fichier = $pictureService->add($image, $folder);
                    $img = new Images();
                    $img->setNom($fichier);
                    $utilisateur->addImage($img);
                }
                $entityManager->persist($user);
                $entityManager->flush();
                return $this->redirectToRoute('parametre_index', ['id' => $user->getId()]);
            }
            $entityManager->persist($user);
            $entityManager->flush();

            return $this->redirectToRoute('app_home');
        }
        
        return $this->render('parametre/index.html.twig', compact(
            'categories',
            'userForm',
            'utilisateurForm',
            'imagesForm',
            'image',
        ));
    }


*/