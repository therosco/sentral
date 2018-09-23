<?php

namespace App\Repository;

use App\Entity\Organiser;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Organiser|null find($id, $lockMode = null, $lockVersion = null)
 * @method Organiser|null findOneBy(array $criteria, array $orderBy = null)
 * @method Organiser[]    findAll()
 * @method Organiser[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class OrganiserRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Organiser::class);
    }

//    /**
//     * @return Organiser[] Returns an array of Organiser objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('o.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Organiser
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
