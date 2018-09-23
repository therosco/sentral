<?php

namespace App\Repository;

use App\Entity\Venue;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Venue|null find($id, $lockMode = null, $lockVersion = null)
 * @method Venue|null findOneBy(array $criteria, array $orderBy = null)
 * @method Venue[]    findAll()
 * @method Venue[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class VenueRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Venue::class);
    }

    public function findDefaultVenue(): ?Venue {
        return $this->createQueryBuilder('v')
            ->andWhere('v.isDefault = :val')
            ->setParameter('val', true)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }

//    /**
//     * @return Venue[] Returns an array of Venue objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('v')
            ->andWhere('v.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('v.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Venue
    {
        return $this->createQueryBuilder('v')
            ->andWhere('v.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
