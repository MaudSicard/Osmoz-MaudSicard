<?php

namespace App\Repository;

use App\Entity\Mail;
use App\Entity\User;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;


/**
 * @method Mail|null find($id, $lockMode = null, $lockVersion = null)
 * @method Mail|null findOneBy(array $criteria, array $orderBy = null)
 * @method Mail[]    findAll()
 * @method Mail[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MailRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Mail::class);
    }

    /**
     * Find all mails ordered by createdAt
     * @return Mail[] Returns an array of Mail objects
     */
    public function findAllOrderedByCreatedAT()
    {
        $qb = $this->createQueryBuilder('m')
            ->orderBy('m.createdAt', 'DESC');
            
        return $qb->getQuery()->getResult();
    }

    /**
     * Find all mails by id ordered by createdAt
     * 
     * @return Mail[] Returns an array of Mail objects
     */
    public function findAllByIdOrderedByCreatedAT(User $user)
    {
        $entityManager = $this->getEntityManager();

        $query = $entityManager->createQuery(
            'SELECT m
            FROM App\Entity\Mail m
            INNER JOIN m.users u
            WHERE m.users = :user
            ORDER BY m.createdAt DESC'
        );
        
        return $query.setParameter("user", $user)->getResult();
    }
    // /**
    //  * @return Mail[] Returns an array of Mail objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('m.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Mail
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}