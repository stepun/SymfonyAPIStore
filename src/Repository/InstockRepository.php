<?php

namespace App\Repository;

use App\Entity\Instock;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Instock|null find($id, $lockMode = null, $lockVersion = null)
 * @method Instock|null findOneBy(array $criteria, array $orderBy = null)
 * @method Instock[]    findAll()
 * @method Instock[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class InstockRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Instock::class);
    }

    // /**
    //  * @return Instock[] Returns an array of Instock objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('i.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Instock
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
