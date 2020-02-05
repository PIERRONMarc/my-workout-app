<?php

namespace App\Repository;

use App\Entity\Session;
use DateTime;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use Symfony\Component\Validator\Constraints\Date;

/**
 * @method Session|null find($id, $lockMode = null, $lockVersion = null)
 * @method Session|null findOneBy(array $criteria, array $orderBy = null)
 * @method Session[]    findAll()
 * @method Session[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SessionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Session::class);
    }

    // /**
    //  * @return Session[] Returns an array of Session objects
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

    /*
    public function findOneBySomeField($value): ?Session
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */

    public function findLast() {
        $today = new DateTime();
        return $this->createQueryBuilder('s')
            ->andWhere('s.day < :today')
            ->setParameter('today', $today)
            ->orderBy('s.day', 'DESC')
            ->setMaxResults(1)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
}
