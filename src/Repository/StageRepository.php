<?php

namespace App\Repository;

use App\Entity\Stage;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Stage|null find($id, $lockMode = null, $lockVersion = null)
 * @method Stage|null findOneBy(array $criteria, array $orderBy = null)
 * @method Stage[]    findAll()
 * @method Stage[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class StageRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Stage::class);
    }

    // /**
    //  * @return Stage[] Returns an array of Stage objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */
    public function stageParEntreprise($nom)
    {
        return $this-> createQueryBuilder('s')
                    ->select('s,e')
                    ->join('s.entreprise','e')
                    ->where('e.nom = :nomEntreprise')
                    ->setParameter('nomEntreprise',$nom)
                    ->getQuery()
                    ->getResult();

    }

    public function stageParFormation($nom)
    {
        $gestionnaireEntite = $this->getEntityManager();

        $requete = $gestionnaireEntite -> createQuery ("SELECT s,f
        FROM App\Entity\Stage s
        JOIN s.formation f
        where f.nomCourt = :nomFormation");
        
        $requete->setParameter('nomFormation',$nom);
        return $requete->execute();
    }


    public function ListeDeStages()
    {
        $gestionnaireEntite = $this->getEntityManager();

        $requete = $gestionnaireEntite -> createQuery ("SELECT s,e
        FROM App\Entity\Stage s
        JOIN s.entreprise e");
        return $requete->execute();
    }

    // public function DetailStage($id)
    // {
    //     $gestionnaireEntite = $this->getEntityManager();

    //     $requete = $gestionnaireEntite -> createQuery ("SELECT s
    //     FROM App\Entity\Stage s
    //     JOIN s.formation f
    //     JOIN s.entreprise e
    //     where s.id = :idStage");
        
    //     $requete->setParameter('idStage',$id);
    //     return $requete->execute();
    // }

    /*
    public function findOneBySomeField($value): ?Stage
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
