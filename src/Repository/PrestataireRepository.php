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
  
    public function findByCategorieDeServices($categ)
{
    return $this->createQueryBuilder('p')
        ->join('p.CategorieDeServices', 'c')
        ->andWhere('c.id = :categ_id')
        ->setParameter('categ_id', $categ->getId())
        ->getQuery()
        ->getResult();
}

    public function findByCategorieDeServicesId(int $categorieDeServicesId): array
    {
        return $this->createQueryBuilder('p')
            ->innerJoin('p.CategorieDeServices', 'c')
            ->andWhere('c.id = :categorieDeServicesId')
            ->setParameter('categorieDeServicesId', $categorieDeServicesId)
            ->getQuery()
            ->getResult();
    
    }
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
