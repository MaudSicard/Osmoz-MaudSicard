<?php

namespace App\Repository;

use App\Entity\Type;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Type|null find($id, $lockMode = null, $lockVersion = null)
 * @method Type|null findOneBy(array $criteria, array $orderBy = null)
 * @method Type[]    findAll()
 * @method Type[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TypeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Type::class);
    }

    // /**
    //  * @return Type[] Returns an array of Type objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('t.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Type
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */

      /**
     * All types order by created_at
     *
     * @return void
     */
    public function findAllTypeByCreatedAt()
    {
        return $this->createQueryBuilder('t')
            ->orderBy('t.createdAt', 'DESC')
            ->getQuery()
            ->getResult()
        ;
    }

    /**
     * Books by type and user's departement
     *
     * @return void
     */
    public function findBooksTypeByDepartement($id, $departement)
    {
        return $this->createQueryBuilder('t')
            ->innerJoin('t.books', 'b')
            ->innerJoin('b.user', 'u')
            ->andWhere('t.id = :id')
            ->setParameter('id', $id)
            ->andWhere('u.departement = :departement')
            ->setParameter('departement', $departement)
            ->getQuery()
            ->getResult()
        ;
    }


    /**
     * Movies by type and user's departement
     *
     * @return void
     */
    public function findMoviesTypeByDepartement($id, $departement)
    {
        return $this->createQueryBuilder('t')
            ->innerJoin('t.movies', 'm')
            ->innerJoin('m.user', 'u')
            ->andWhere('t.id = :id')
            ->setParameter('id', $id)
            ->andWhere('u.departement = :departement')
            ->setParameter('departement', $departement)
            ->getQuery()
            ->getResult()
        ;
    }

     /**
     * Musics by type and user's departement
     *
     * @return void
     */
    public function findMusicsTypeByDepartement($id, $departement)
    {
        return $this->createQueryBuilder('t')
            ->innerJoin('t.music', 'm')
            ->innerJoin('m.user', 'u')
            ->andWhere('t.id = :id')
            ->setParameter('id', $id)
            ->andWhere('u.departement = :departement')
            ->setParameter('departement', $departement)
            ->getQuery()
            ->getResult()
        ;
    }

}
