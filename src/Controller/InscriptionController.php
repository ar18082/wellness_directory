<?php

namespace App\Controller;

use App\Form\RoleType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
//use Symfony\Component\Security\Core\Security;

use App\Entity\Stage;
use App\Entity\Promotion;
use App\Entity\Internaute;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\SecurityBundle\Security;
use App\Entity\CategorieDeServices;
use App\Entity\Prestataire;
use App\Entity\Utilisateur;
use App\Form\RechercheType;
use App\Service\PrestataireRecent;

class InscriptionController extends AbstractController
{
    #[Route('/inscription', name: 'app_inscription')]
    public function index( EntityManagerInterface $entityManager): Response
    {

        $id = $_GET['id'];

        
     
        
        return $this->render('inscription/index.html.twig', [
            'controller_name' => 'test',
            'id' => $id,
            
                           
           
        ]);
    }

    #[Route('/inscription/valide', name: 'app_inscription_valide')]
    public function inscValid(Request $request, EntityManagerInterface $entityManager): Response
    {
      
       /* 
            //dd($request);
    

        $newsletter = $request->request->get('newsletter'); 
        if($newsletter == 'on'){
            $newsletter=true;
        }else{
            $newsletter=false;
        };
        
        if($request->request->get('role') == 'INT'){
            $internaute = new Internaute(); 
            $internaute->setNom($request->request->get('nom_pre'));
            $internaute->setPrenom($request->request->get('prenom'));
            $internaute->setNewsletter($newsletter); 

            $entityManager->persist($internaute);
            //$entityManager->flush();
            
            $id_int = $internaute->getId();

            $internauteRepository = $entityManager->getRepository(Internaute::class);
            $lastInternaute = $internauteRepository->findOneBy([], ['createdAt' => 'DESC']);
            
            $id = $request->request->get('user_id_int');
           
        }

        if($request->request->get('role') == 'PRE'){
            $prestataire = new Prestataire();
            $prestataire->setNom($request->request->get('nom_pre'));
            $prestataire->setSiteInternet($request->request->get('Site_internet'));
            $prestataire->setNumTel($request->request->get('telephone'));
            $prestataire->setNumTva($request->request->get('tva'));



            $entityManager->persist($prestataire);

            if(!empty($request->request->get('nom_stg'))){
                $stage = new Stage();
                $stage->setNom($request->request->get('nom_stg'));
                $stage->setDescription($request->request->get('description_stg'));
                $stage->setTarif($request->request->get('tarif_stg'));
                $stage->setDebut($request->request->get('dateIn_stg'));
                $stage->setFin($request->request->get('dateOut_stg'));
                $stage->setAffichageDe($request->request->get('affichageIn_stg'));
                $stage->setAffichageJusque($request->request->get('affichageOut_stg'));

                $entityManager->persist($stage);
                

            }
            if(!empty($request->request->get('nom_promo'))){
                $promotion = new Promotion();
                $promotion->setNom($request->request->get('nom_promo'));
                $promotion->setDescription($request->request->get('description_promo'));
                $promotion->setDebut($request->request->get('dateIn_promo'));
                $promotion->setFin($request->request->get('dateOut_promo'));

                $entityManager->persist($promotion);
            }
                      
            //$entityManager->flush();

            $id_pre = $prestataire->getId();

            $id = $request->request->get('user_id_pre');
        }  





        $repository = $entityManager->getRepository(Utilisateur::class);
        $utilisateur = $repository->find($request->request->get($id));
        $utilisateur->setRoles($request->request->get('role'));
        $utilisateur->setAdresseNumber($request->request->get('numero'));
        $utilisateur->setAdresseRue($request->request->get('rue'));





        
*/
$form = $this->createForm(RechercheType::class);
$form->handleRequest($request);
if ($form->isSubmitted() && $form->isValid()) {
    $datas = $form->getData();
    return $this->redirectToRoute('app_home');
}

//récupération des catégories de services 
/* 
    attention introduire un if valide == true
*/
$repository = $entityManager->getRepository(CategorieDeServices::class);
$categorieDeServices = $repository->findAll();


// choix à faire dans le dashboard de l'admin
// service du mois mis à l'honneur 
$serviceDuMois = $repository->findOneBy(['EnAvant' => 1 ]);


// récupération des prestataires
/*
dans prestataire repository créer une requete custom avec un joinleft d'utilisateur */
$repository = $entityManager->getRepository(Utilisateur::class);
$prestataires = $repository->FindPrestaRecent();

//dd($prestataires[0]->getPrestataire()->getNom());
        
        
        return $this->render('home/index.html.twig', [
            'title' => 'Page d\'acceuil',
            'form' =>$form ->createView(),
            'categorieDeServices' => $categorieDeServices, // toutes les catégories de service present dans la sidebar
            'serviceDuMois' => $serviceDuMois, // services mis en avant pour 1 mois
            'prestataires' => $prestataires // 4 derniers prestataires inscrit

        ]);
    }

    #[Route('/inscription/json', name: 'inscription_json', methods:['POST'])]
    public function formulaire_inscription(Request $request, EntityManagerInterface $entityManager)
    {
        $datas = $request->toArray();

        dump($datas);

        die();

        //return $this->redirectToRoute('app_inscription');
            
           
       
       // dd($data);

       return new JsonResponse('success');
      
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