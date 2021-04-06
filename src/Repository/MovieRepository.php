<?php

namespace App\Repository;

use App\Entity\Movie;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Movie|null find($id, $lockMode = null, $lockVersion = null)
 * @method Movie|null findOneBy(array $criteria, array $orderBy = null)
 * @method Movie[]    findAll()
 * @method Movie[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MovieRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Movie::class);
    }

    /**
     * Find 10 movies ordered by createdAt
     * 
     * @return Movie[] Returns an array of Movie objects
     */
    public function findAllOrderedByCreatedAtAsc()
    {
        $qb = $this->createQueryBuilder('m')
            ->orderBy('m.createdAt', 'DESC')
            ->setMaxResults(10);
            
        return $qb->getQuery()->getResult();
    }

    /**
     * Find all movies ordered by createdAt
     * 
     * @return Movie[] Returns an array of Movie objects
     */
    public function findAllOrderedByCreatedAT()
    {
        $qb = $this->createQueryBuilder('m')
            ->orderBy('m.createdAt', 'DESC');
            
        return $qb->getQuery()->getResult();
    }
  /**
     * Return all movies where title correspond at the keyword
     *
     * @return void
     */
    public function findMoviesByKeyWord($keyWord, $departement)
    {
        return $this->createQueryBuilder('m')
            ->innerJoin('b.user', 'u')
            ->andWhere('u.departement LIKE :departement')
            ->setParameter('departement', $departement)
            ->orWhere('m.name LIKE :keyWord')
            ->setParameter('keyWord', '%'.$keyWord.'%')
            ->getQuery()
            ->getResult()
        ;
    }

       /**
     * Find 5 movies ordered by createdAt for home
     * 
     * @return Movie[] Returns an array of Movie objects
     */
    public function findMoviesHome()
    {
        $qb = $this->createQueryBuilder('m')
            ->orderBy('m.createdAt', 'DEASC')
            ->setMaxResults(5);
            
        return $qb->getQuery()->getResult();
    }
    /*

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
    public function findOneBySomeField($value): ?Movie
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
