<?php

namespace App\Repository;

use App\Entity\Book;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Book|null find($id, $lockMode = null, $lockVersion = null)
 * @method Book|null findOneBy(array $criteria, array $orderBy = null)
 * @method Book[]    findAll()
 * @method Book[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BookRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Book::class);
    }

    // /**
    //  * @return Book[] Returns an array of Book objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('b.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Book
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }

  
    /**
     * All books order by created_at
     *
     * @return void
     */
    public function findAllBookByUserType()
    {
        $entityManager = $this->getEntityManager();

        $query = $entityManager->createQuery(
            'SELECT b, u, t
            FROM App\Entity\Book b
            INNER JOIN b.user u
            INNER JOIN b.type t
            ORDER BY b.id');

        return $query->getResult();
    }


    /**
     * All books with their type and user
     *
     * @return void
     */
    public function findAllByCreatedAt()
    {
        return $this->createQueryBuilder('b')
            ->orderBy('b.createdAt', 'DESC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }

    /**
     * Return all books where title and/or author correspond at the keyword
     *
     * @return void
     */
    public function findBooksByKeyWord($keyWord, $departement)
    {
        return $this->createQueryBuilder('b')
            ->innerJoin('b.user', 'u')
            ->andWhere('u.departement LIKE :departement')
            ->setParameter('departement', $departement)
            ->orWhere('b.name LIKE :keyWord')
            ->setParameter('keyWord', '%'.$keyWord.'%')
            ->getQuery()
            ->getResult()
        ;
    }


        /**
     * Find 5 books ordered by createdAt for home
     * 
     * @return Book[] Returns an array of Movie objects
     */
    public function findBooksHome()
    {
        $qb = $this->createQueryBuilder('b')
            ->orderBy('b.createdAt', 'DESC')
            ->setMaxResults(5);
            
        return $qb->getQuery()->getResult();
    }

    
    /**
     * Books by type and by user's departement
     */
    public function findBooksByDepartementAndType($id, $departement)
    {
        return $this->createQueryBuilder('b')
            ->orderBy('b.createdAt', 'DESC')
            ->innerJoin('b.user', 'u')
            ->andWhere('u.departement = :departement')
            ->setParameter('departement', $departement)
            ->innerJoin('b.type', 't')
            ->andWhere('t.id = :id')
            ->setParameter('id', $id)
            ->getQuery()
            ->getResult()
        ;
    }

}
