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
use Faker\Factory;
use DateTime;
use App\Entity\Stage;
use App\Entity\Promotion;
use App\Entity\Internaute;
use App\Entity\Images;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\SecurityBundle\Security;
use App\Entity\CategorieDeServices;
use App\Entity\Prestataire;
use App\Entity\Utilisateur;
use App\Entity\VilleCodePost;
use App\Form\CategServiceType;
use App\Form\RechercheType;
use App\Service\PrestataireRecent;


class InscriptionController extends AbstractController
{
    #[Route('/inscription', name: 'app_inscription')]
    public function index( EntityManagerInterface $entityManager): Response
    {

        $id = $_GET['id'];

        $repository = $entityManager->getRepository(CategorieDeServices::class);
        $categorieDeServices = $repository->findBy(['Valide'=>true]);

      
        
        $faker = Factory::create();
        
        
        
        return $this->render('inscription/index.html.twig', [
            'controller_name' => 'test',
            'id' => $id,
            'categorieDeServices'=>$categorieDeServices,
            'faker' => $faker,
           
            
                           
           
        ]);
    }

    #[Route('/inscription/valide', name: 'app_inscription_valide')]
    public function inscValid(Request $request, EntityManagerInterface $entityManager, ValidatorInterface $validator): Response
    {
       
     
        

        $role = $request->request->get('role');
        

        if($role == 'INT'){
            $fichier= $request->files->get('file_int');
            
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
            $fichier = $request->files->get('file_pre');
            $utilisateurId = $request->request->get('user_id_pre');
            $prestataire = new Prestataire();
            $prestataire->setNom($request->request->get('nom_pre'));
            $prestataire->setSiteInternet($request->request->get('Site_internet'));
            $prestataire->setNumTel($request->request->get('telephone'));
            $prestataire->setNumTva($request->request->get('tva'));
            $prestataire->setPresentation($request->request->get('presentation_pre'));
            $options = $request->get('options');
            foreach ($options as $optionId) {
                $categorieDeService = $entityManager->getRepository(CategorieDeServices::class)->find($optionId);
                if ($categorieDeService) {
                    $prestataire->addCategorieDeService($categorieDeService);
                }
            }
            
            $entityManager->persist($prestataire);
            $entityManager->flush();

        }
           
        if ($fichier instanceof UploadedFile) {
            
           
            $originalName = $fichier->getClientOriginalName();
            $extension = pathinfo($originalName, PATHINFO_EXTENSION);
           
            if($role == 'INT'){
                $type = 'profil';
               
            }elseif($role=='PRE'){
                $type = 'logo';
               
                
            }
            $nomFichier =$role.'_'. $type .'_'. $utilisateurId.'.'.$extension;
                       
            $destination = $this->getParameter('kernel.project_dir') . '/public/img/'.$role ;

                       
            $fichier->move($destination, $nomFichier);

        } 

       
        $image = new Images();
        $image->setImage('img/'.$role.'/'.$nomFichier);
        $repositoryVilleCP = $entityManager->getRepository(VilleCodePost::class);
        if($role == 'INT'){
            $villeCP= $repositoryVilleCP->find($request->request->get('code_postal'));
        }else{
            $villeCP= $repositoryVilleCP->find($request->request->get('cp'));
        }
         
        $repository = $entityManager->getRepository(Utilisateur::class);
        $utilisateur = $repository->find($utilisateurId);
        $utilisateur->setAdresseNumber($request->request->get('numero'));
        $utilisateur->setAdresseRue($request->request->get('rue'));
        $utilisateur->setVilleCodePost($villeCP);
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
                $debut = new DateTime($request->request->get('dateIn_stg')); 
                $stage->setDebut($debut);
                $fin = new DateTime($request->request->get('dateOut_stg'));
                $stage->setFin($fin);
                $affichageDebut = new DateTime($request->request->get('affichageIn_stg'));
                $stage->setAffichageDe($affichageDebut); 
                $affichageFin = new DateTime($request->request->get('affichageOut_stg'));
                $stage->setAffichageJusque($affichageFin);
                $stage->setPrestataire($prestataire);
                $entityManager->persist($stage);
                $entityManager->flush();
            }

            if($request->request->get('nom_promo')){

                
                $promo = new Promotion();
                $promo->setNom($request->request->get('nom_promo'));
                $promo->setDescription($request->request->get('description_promo'));
                $debut = new DateTime($request->request->get('dateIn_promo')); 
                $promo->setDebut($debut);
                $fin = new DateTime($request->request->get('dateOut_promo'));
                $promo->setFin($fin);
                // génére le fichier pdf 
                $promo->setDocumentPdf('');
                $affichageDebut = new DateTime($request->request->get('affichageIn_promo'));
                $promo->setAffichageDe($affichageDebut);
                $affichageFin = new DateTime($request->request->get('affichageOut_promo'));
                $promo->setAffichageJusque($affichageFin);
                $options = $request->get('options');
            foreach ($options as $optionId) {
                $categorieDeService = $entityManager->getRepository(CategorieDeServices::class)->find($optionId);
                if ($categorieDeService) {
                    $promo->setCategorieDeServices($categorieDeService);
                }
            }
                //$promo->setCategorieDeServices($request->request->get('categService_promo'));
                $promo->setPrestataire($prestataire);
                $entityManager->persist($promo);
                $entityManager->flush();
            }
        
        }
        $entityManager->persist($utilisateur);
        $entityManager->flush();

       
        $entityManager->persist($image);
        $entityManager->flush();
                        
      
        
        return $this->redirectToRoute('app_home');

    }
}
    