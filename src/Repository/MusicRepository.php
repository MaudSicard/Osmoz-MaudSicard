<?php

namespace App\Repository;

use App\Entity\Music;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Music|null find($id, $lockMode = null, $lockVersion = null)
 * @method Music|null findOneBy(array $criteria, array $orderBy = null)
 * @method Music[]    findAll()
 * @method Music[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MusicRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Music::class);
    }

    // /**
    //  * @return Music[] Returns an array of Music objects
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
    public function findOneBySomeField($value): ?Music
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */

    /**
     * All musics order by created_at
     *
     * @return void
     */
    public function findAllMusicByCreatedAt()
    {
        return $this->createQueryBuilder('m')
            ->orderBy('m.createdAt', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }

     /**
     * All musics with their type and user
     *
     * @return void
     */
    public function findAllMusicByUserType()
    {
        $entityManager = $this->getEntityManager();

        $query = $entityManager->createQuery(
            'SELECT m, u, t
            FROM App\Entity\Music m
            INNER JOIN m.user u
            INNER JOIN m.type t
            ORDER BY m.createdAt');

        return $query->getResult();
    }

    /**
     * Return all musics where title and/or artist correspond at the keyword
     *
     * @return void
     */
    public function findMusicsByKeyWord($keyWord, $departement)
    {
        return $this->createQueryBuilder('m')
            ->innerJoin('b.user', 'u')
            ->andWhere('u.departement LIKE :departement')
            ->setParameter('departement', $departement)
            ->andWhere('m.name LIKE :keyWord')
            ->orWhere('m.artist LIKE :keyWord')
            ->setParameter('keyWord', '%'.$keyWord.'%')
            ->getQuery()
            ->getResult()
        ;
    }

    /**
     * Find 5 musics ordered by createdAt for home
     * 
     * @return Music[] Returns an array of Movie objects
     */
    public function findMusicsHome()
    {
        $qb = $this->createQueryBuilder('m')
            ->orderBy('m.createdAt', 'ASC')
            ->setMaxResults(5);
            
        return $qb->getQuery()->getResult();
    }

    
}
