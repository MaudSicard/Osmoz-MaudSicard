<?php

namespace App\Repository;

use App\Entity\Movie;
use App\Entity\Gender;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

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

    /**
     * All genders order by created_at
     */
    public function findAllGenderByCreatedAt()
    {
        return $this->createQueryBuilder('g')
            ->orderBy('g.createdAt', 'DESC')
            ->getQuery()
            ->getResult()
        ;
    }

    /**
     * Books by gender and user's departement
     *
     * @return void
     */
    public function findBooksGenderByDepartement($id, $departement)
    {
        return $this->createQueryBuilder('g')
            ->innerJoin('g.books', 'b')
            ->innerJoin('b.user', 'u')
            ->andWhere('g.id = :id')
            ->setParameter('id', $id)
            ->andWhere('u.departement = :departement')
            ->setParameter('departement', $departement)
            ->getQuery()
            ->getResult()
        ;
    }


    /**
     * Movies by gender and user's departement
     *
     * @return void
     */
    public function findMoviesGenderByDepartement($id, $departement)
    {
        return $this->createQueryBuilder('g')
            ->innerJoin('g.movies', 'm')
            ->innerJoin('m.user', 'u')
            ->andWhere('g.id = :id')
            ->setParameter('id', $id)
            ->andWhere('u.departement = :departement')
            ->setParameter('departement', $departement)
            ->getQuery()
            ->getResult()
        ;
    }

     /**
     * Musics by gender and user's departement
     *
     * @return void
     */
    public function findMusicsGenderByDepartement($id, $departement)
    {
        return $this->createQueryBuilder('g')
            ->innerJoin('g.music', 'm')
            ->innerJoin('m.user', 'u')
            ->andWhere('g.id = :id')
            ->setParameter('id', $id)
            ->andWhere('u.departement = :departement')
            ->setParameter('departement', $departement)
            ->getQuery()
            ->getResult()
        ;
    }

}
