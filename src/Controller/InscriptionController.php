<?php

namespace App\Controller;

use App\Form\RoleType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Faker\Factory as FakerFactory;

use App\Entity\Stage;
use App\Entity\Promotion;
use App\Entity\Internaute;
use App\Entity\Images;

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
    public function inscValid(Request $request, EntityManagerInterface $entityManager, ValidatorInterface $validator): Response
    {

       

        $role = $request->request->get('role');
        $fichier = $request->files->get('file');
        if ($fichier instanceof UploadedFile) {
            
            $extension = $fichier->getClientOriginalExtension();
            $mime = $fichier->getClientMimeType();
            $nomFichier = uniqid().'.'.$extension;

            // Déplacer le fichier vers l'emplacement souhaité
            if($role == 'INT'){
                $chemin = 'internautes';
            }elseif($role=='PRE'){
                $chemin = 'prestataires';
                
            }
            $destination = $this->getParameter('kernel.project_dir') . '/public/img/'.$chemin ;
           
            // Générer un nom de fichier unique
            $fichier->move($destination, $nomFichier);

            


           
        } 
    
        if($role == 'INT'){
            $utilisateurId = $request->request->get('user_id_int');
            $internaute = new Internaute();
            $internaute->setNom($request->request->get('nom')) ;
            $internaute->setPrenom($request->request->get('prenom'));
            
            if($request->request->get('newsletter')){
                $internaute->setNewsletter($request->request->get('newsletter'));
            }else{
                $internaute->setNewsletter($request->request->get('newsletter'));
            }

            $entityManager->persist($internaute);
            $entityManager->flush();

        }else{
            $utilisateurId = $request->request->get('user_id_pre');
            $prestataire = new Prestataire();
            $prestataire->setNom($request->request->get('nom_pre'));
            $prestataire->setSiteInternet($request->request->get('Site_internet'));
            $prestataire->setNumTel($request->request->get('telephone'));
            $prestataire->setNumTva($request->request->get('tva'));
            
            $entityManager->persist($prestataire);
            $entityManager->flush();

            

            


        }
        $image = new Images();
        $image->setImage('img/'.$chemin.$nomFichier);

        $repository = $entityManager->getRepository(Utilisateur::class);
        $utilisateur = $repository->find($utilisateurId);
        $utilisateur->setAdresseNumber($request->request->get('numero'));
        $utilisateur->setAdresseRue($request->request->get('rue'));
        $utilisateur->setRoles([$role]);

        if($role == 'INT'){
        $inter_Id = $internaute->getId();
        $internaute = $entityManager->find(Internaute::class, $inter_Id);
        $utilisateur->setInternaute($internaute);
        $image->setInternaute($internaute);
    
        }else{
        $presta_Id = $prestataire->getId();
        $prestataire = $entityManager->find(Prestataire::class, $presta_Id);
        $utilisateur->setPrestataire($prestataire);
        $image->setPrestataire($prestataire);

            if($request->request->get('nom_stg')){
                $stage = new Stage();
                $stage->setNom($request->request->get('nom_stg'));
                $stage->setDescription($request->request->get('description_stg'));
                $stage->setTarif($request->request->get('tarif_stg'));
                $stage->setDebut($request->request->get('dateIn_stg'));
                $stage->setFin($request->request->get('dateOut_stg'));
                $stage->setAffichageDe($request->request->get('affichageIn_stg')); 
                $stage->setAffichageJusque($request->request->get('affichageOut_stg'));
                $stage->setPrestataire($prestataire);
            }

            if($request->request->get('nom_promo')){
                $promo = new Promotion();
                $promo->setNom($request->request->get('nom_promo'));
                $stage->setDescription($request->request->get('description_promo'));
                $stage->setDebut($request->request->get('dateIn_promo'));
                $stage->setFin($request->request->get('dateOut_promo'));
                $stage->setPrestataire($prestataire);
                // ajouter document pdf, date affichage, catégorie de service 

            }
        
        }
        $entityManager->persist($utilisateur);
        $entityManager->flush();

       
        $entityManager->persist($image);
        $entityManager->flush();
                        
        $form = $this->createForm(RechercheType::class);
        $form->handleRequest($request);

        
        //récupération des catégories de services 
        $repository = $entityManager->getRepository(CategorieDeServices::class);
        $categorieDeServices = $repository->findBy(['Valide' => true]);

        // choix à faire dans le dashboard de l'admin
        // service du mois mis à l'honneur 
        $serviceDuMois = $repository->findOneBy(['EnAvant' => 1 ]);


        // récupération des prestataires récent
        $repository = $entityManager->getRepository(Utilisateur::class);
        $prestataires = $repository->FindPrestaRecent();

     
                
        
        return $this->render('home/index.html.twig', [
            'title' => 'Page d\'acceuil',
            'form' =>$form ->createView(),
            'categorieDeServices' => $categorieDeServices, // toutes les catégories de service present dans la sidebar
            'serviceDuMois' => $serviceDuMois, // services mis en avant pour 1 mois
            'prestataires' => $prestataires // 4 derniers prestataires inscrit

        ]);
    }
}
    