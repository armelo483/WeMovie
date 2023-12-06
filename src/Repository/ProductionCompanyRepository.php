<?php

namespace App\Repository;

use App\Entity\ProductionCompany;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ProductionCompany>
 *
 * @method ProductionCompany|null find($id, $lockMode = null, $lockVersion = null)
 * @method ProductionCompany|null findOneBy(array $criteria, array $orderBy = null)
 * @method ProductionCompany[]    findAll()
 * @method ProductionCompany[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProductionCompanyRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ProductionCompany::class);
    }
}
