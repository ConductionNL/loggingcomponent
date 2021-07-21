<?php

namespace App\Repository;

use App\Entity\VerwerktSoortGegeven;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method VerwerktSoortGegeven|null find($id, $lockMode = null, $lockVersion = null)
 * @method VerwerktSoortGegeven|null findOneBy(array $criteria, array $orderBy = null)
 * @method VerwerktSoortGegeven[]    findAll()
 * @method VerwerktSoortGegeven[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class VerwerktSoortGegevenRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Log::class);
    }

    // /**
    //  * @return Log[] Returns an array of Log objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('o.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Log
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
