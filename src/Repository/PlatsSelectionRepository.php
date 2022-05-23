<?php

namespace App\Repository;

use App\Entity\PlatsSelection;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Exception\ORMException;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<PlatsSelection>
 *
 * @method PlatsSelection|null find($id, $lockMode = null, $lockVersion = null)
 * @method PlatsSelection|null findOneBy(array $criteria, array $orderBy = null)
 * @method PlatsSelection[]    findAll()
 * @method PlatsSelection[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PlatsSelectionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PlatsSelection::class);
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(PlatsSelection $entity, bool $flush = false): void
    {
        $this->_em->persist($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function remove(PlatsSelection $entity, bool $flush = false): void
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

//    /**
//     * @return PlatsSelection[] Returns an array of PlatsSelection objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('p.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?PlatsSelection
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
