<?php

namespace App\Repository;

use App\Entity\Productoxpedido;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Productoxpedido|null find($id, $lockMode = null, $lockVersion = null)
 * @method Productoxpedido|null findOneBy(array $criteria, array $orderBy = null)
 * @method Productoxpedido[]    findAll()
 * @method Productoxpedido[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProductoxpedidoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Productoxpedido::class);
    }

    // /**
    //  * @return Productoxpedido[] Returns an array of Productoxpedido objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Productoxpedido
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
