<?php

namespace App\Repository;

use App\Entity\Fomration;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Fomration|null find($id, $lockMode = null, $lockVersion = null)
 * @method Fomration|null findOneBy(array $criteria, array $orderBy = null)
 * @method Fomration[]    findAll()
 * @method Fomration[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FomrationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Fomration::class);
    }

    // /**
    //  * @return Fomration[] Returns an array of Fomration objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('f.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Fomration
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
