<?php

namespace App\Repository;

use App\Entity\SousRubrique;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<SousRubrique>
 */
class SousRubriqueRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SousRubrique::class);
    }

    public function getSomeSousrub($id)
    {
        $qb = $this->createQueryBuilder('a');
        $qb 
            ->andWhere('a.rubrique = :id')
            ->setParameter('id', $id)
            ->getQuery();
        $categories = $qb->getQuery()-> getResult();

        return $categories;
    }
    //    /**
    //     * @return SousRubrique[] Returns an array of SousRubrique objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('s')
    //            ->andWhere('s.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('s.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?SousRubrique
    //    {
    //        return $this->createQueryBuilder('s')
    //            ->andWhere('s.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
