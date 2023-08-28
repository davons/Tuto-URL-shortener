<?php

namespace App\Repository;

use App\Entity\UrlList;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<UrlList>
 *
 * @method UrlList|null find($id, $lockMode = null, $lockVersion = null)
 * @method UrlList|null findOneBy(array $criteria, array $orderBy = null)
 * @method UrlList[]    findAll()
 * @method UrlList[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UrlListRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, UrlList::class);
    }

//    /**
//     * @return UrlList[] Returns an array of UrlList objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('u')
//            ->andWhere('u.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('u.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?UrlList
//    {
//        return $this->createQueryBuilder('u')
//            ->andWhere('u.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
