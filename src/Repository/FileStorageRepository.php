<?php

namespace App\Repository;

use App\Entity\FileStorage;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method FileStorage|null find($id, $lockMode = null, $lockVersion = null)
 * @method FileStorage|null findOneBy(array $criteria, array $orderBy = null)
 * @method FileStorage[]    findAll()
 * @method FileStorage[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FileStorageRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, FileStorage::class);
    }

//    /**
//     * @return FileStorage[] Returns an array of FileStorage objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('f.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?FileStorage
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
