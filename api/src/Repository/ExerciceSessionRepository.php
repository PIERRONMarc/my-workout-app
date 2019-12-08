<?php

namespace App\Repository;

use App\Entity\ExerciceSession;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method ExerciceSession|null find($id, $lockMode = null, $lockVersion = null)
 * @method ExerciceSession|null findOneBy(array $criteria, array $orderBy = null)
 * @method ExerciceSession[]    findAll()
 * @method ExerciceSession[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ExerciceSessionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ExerciceSession::class);
    }

    // /**
    //  * @return ExerciceSession[] Returns an array of ExerciceSession objects
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
    public function findOneBySomeField($value): ?ExerciceSession
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
