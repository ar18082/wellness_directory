<?php

namespace App\Repository;

use App\Entity\VilleCodePost;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<VilleCodePost>
 *
 * @method VilleCodePost|null find($id, $lockMode = null, $lockVersion = null)
 * @method VilleCodePost|null findOneBy(array $criteria, array $orderBy = null)
 * @method VilleCodePost[]    findAll()
 * @method VilleCodePost[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class VilleCodePostRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, VilleCodePost::class);
    }

//    /**
//     * @return VilleCodePost[] Returns an array of VilleCodePost objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('v')
//            ->andWhere('v.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('v.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?VilleCodePost
//    {
//        return $this->createQueryBuilder('v')
//            ->andWhere('v.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
