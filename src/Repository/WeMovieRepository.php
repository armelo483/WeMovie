<?php

namespace App\Repository;

use App\Entity\WeMovie;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<WeMovie>
 *
 * @method WeMovie|null find($id, $lockMode = null, $lockVersion = null)
 * @method WeMovie|null findOneBy(array $criteria, array $orderBy = null)
 * @method WeMovie[]    findAll()
 * @method WeMovie[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class WeMovieRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, WeMovie::class);
    }

//    /**
//     * @return WeMovie[] Returns an array of WeMovie objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('w')
//            ->andWhere('w.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('w.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?WeMovie
//    {
//        return $this->createQueryBuilder('w')
//            ->andWhere('w.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
