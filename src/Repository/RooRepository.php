<?php

namespace App\Repository;

use App\Entity\Roo;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Roo>
 *
 * @method Roo|null find($id, $lockMode = null, $lockVersion = null)
 * @method Roo|null findOneBy(array $criteria, array $orderBy = null)
 * @method Roo[]    findAll()
 * @method Roo[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RooRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Roo::class);
    }

//    /**
//     * @return Roo[] Returns an array of Roo objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('r')
//            ->andWhere('r.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('r.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Roo
//    {
//        return $this->createQueryBuilder('r')
//            ->andWhere('r.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
