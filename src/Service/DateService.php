<?php

// src/Service/DateService.php
namespace App\Service;

use Doctrine\ORM\EntityManagerInterface;

class DateService
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function getDate()
    {
        // Implémentez la logique pour récupérer la date depuis la base de données
        // par exemple, si vous avez une entité DateEntity avec un champ date,
        // vous pouvez utiliser une requête DQL pour récupérer la date.

        
      return 'je suis ok ';
    }
}

class PrestataireRecent
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function getPrestataire()
    {
        

        $prestataire = $this->entityManager->getRepository(Prestataire::class)->findOneBy([], ['id' => 'DESC'], 4);

         return $prestataire;
    }
}
