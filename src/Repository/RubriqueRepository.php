<?php

namespace App\Repository;

use App\Entity\Rubrique;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Rubrique>
 */
class RubriqueRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Rubrique::class);
    }

    public function getSomeRub($id)
    {
        $qb = $this->createQueryBuilder('a');
        $qb 
            ->andWhere('a.id = :id')
            ->setParameter('id', $id)
            ->getQuery();
        $categories = $qb->getQuery()-> getResult();

        return $categories;
    }

    public function search($search)
    {
        $qb = $this->createQueryBuilder('a');
        $qb 
            ->andWhere('a.libelle, a.image, a.nom = %:id%')
            ->setParameter('id', $search)
            ->getQuery();
        $categories = $qb->getQuery()-> getResult();

        return $categories;
    }

    //    /**
    //     * @return Rubrique[] Returns an array of Rubrique objects
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

    //    public function findOneBySomeField($value): ?Rubrique
    //    {
    //        return $this->createQueryBuilder('r')
    //            ->andWhere('r.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
