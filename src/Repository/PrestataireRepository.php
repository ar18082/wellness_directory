<?php

namespace App\Repository;

use App\Entity\Prestataire;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Prestataire>
 *
 * @method Prestataire|null find($id, $lockMode = null, $lockVersion = null)
 * @method Prestataire|null findOneBy(array $criteria, array $orderBy = null)
 * @method Prestataire[]    findAll()
 * @method Prestataire[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PrestataireRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Prestataire::class);
    }
   /* public function FindPrestaRecent2(): array
    {
        $entityManager = $this->getEntityManager();

        $query = $entityManager->createQuery('
            SELECT u
            FROM App\Entity\Utilisateur u
            LEFT JOIN u.prestataire p
            WHERE u.inscription IS NOT NULL
            ORDER BY u.inscription DESC
            
        ');

        $query->setMaxResults(4);

        return $query->getResult();
    }*/

    /**
     * @return [] Returns an array of Prestataire Names
    */
   public function findByAllNames($value): array
    {
       return $this->createQueryBuilder('p')
            ->andWhere('p.nom LIKE :val')
            ->setParameter('val', '%'. $value . '%')
            ->getQuery()
            ->getResult()
        ;
    }

//    public function findOneBySomeField($value): ?Prestataire
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
