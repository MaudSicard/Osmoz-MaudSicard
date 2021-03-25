<?php

namespace App\Repository;

use App\Entity\Gender;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Gender|null find($id, $lockMode = null, $lockVersion = null)
 * @method Gender|null findOneBy(array $criteria, array $orderBy = null)
 * @method Gender[]    findAll()
 * @method Gender[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class GenderRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Gender::class);
    }

    /**
     * Find all gender in movie
     * 
     * @return Movie[] Returns an array of Movie objects
     */
    public function findAllGenderMovie()
    {   
        $entityManager = $this->getEntityManager();

        $query = 
        $entityManager->createQuery(
            'SELECT * FROM `gender`
            WHERE media = movie'
        );
                

        return $query->getResult();
    }

       /**
     * Find all gender in movie
     * 
     * @return Movie[] Returns an array of Movie objects
     */
    public function findAllGenderMovie2()
    {
        $qb = $this->createQueryBuilder('gender')
                   ->where('gender.media = movie');
            
        return $qb->getQuery()->getResult();
    }


    // /**
    //  * @return Gender[] Returns an array of Gender objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('g')
            ->andWhere('g.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('g.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Gender
    {
        return $this->createQueryBuilder('g')
            ->andWhere('g.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
