<?php

namespace App\Repository;

use App\Entity\Entreprise;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Entreprise|null find($id, $lockMode = null, $lockVersion = null)
 * @method Entreprise|null findOneBy(array $criteria, array $orderBy = null)
 * @method Entreprise[]    findAll()
 * @method Entreprise[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EntrepriseRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Entreprise::class);
    }

    // /**
    //  * @return Entreprise[] Returns an array of Entreprise objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('e.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Entreprise
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */

    public function TrieParEntreprise()
    {
        $gestionnaireEntite = $this->getEntityManager();

        $requete = $gestionnaireEntite -> createQuery ("SELECT e,s
        FROM App\Entity\Entreprise e
        join e.stages s");
        return $requete->execute();
    }

    public function RecupererEntrepriseAvecNom($nom)
    {
        $gestionnaireEntite = $this->getEntityManager();

        $requete = $gestionnaireEntite -> createQuery ("SELECT e
        FROM App\Entity\Entreprise e
        where e.nom = :nomEntreprise");
        $requete->setParameter('nomEntreprise',$nom);
        return $requete->getOneOrNullResult();
    }
}
