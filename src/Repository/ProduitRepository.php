<?php

namespace App\Repository;

use App\Entity\Produit;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Produit>
 */
class ProduitRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Produit::class);
    }

    public function getSomeProduit($id)
    {
        $qb = $this->createQueryBuilder('a');
        $qb 
            ->andWhere('a.id = :id')
            ->setParameter('id', $id)
            ->getQuery();
        $categories = $qb->getQuery()-> getResult();
        return $categories;
    }

    public function getSome($param)
    {
        $qb = $this->createQueryBuilder('a');
        $qb 
            ->andWhere('a.libelle like :param')
            ->setParameter('param', '%'.$param.'%')
            ->getQuery();
        $categories = $qb->getQuery()-> getResult();
        return $categories;
    }

    //    /**
    //     * @return Produit[] Returns an array of Produit objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('p')
    //            ->andWhere('p.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('p.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Produit
    //    {
    //        return $this->createQueryBuilder('p')
    //            ->andWhere('p.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
