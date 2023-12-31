<?php

namespace App\Repository;

use App\Entity\Compra;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Compra>
 *
 * @method Compra|null find($id, $lockMode = null, $lockVersion = null)
 * @method Compra|null findOneBy(array $criteria, array $orderBy = null)
 * @method Compra[]    findAll()
 * @method Compra[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CompraRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Compra::class);
    }

    public function save(Compra $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Compra $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

   /**
    * @return Compra[] Returns an array of Compra objects
    */
   public function filter($id, $usuario, $orden): array
   {
        $queryBuilder = $this->createQueryBuilder('c');

        if ($id) {
            $queryBuilder
                ->andWhere('c.id = :id')
                ->setParameter('id', $id);
        }
        if ($usuario) {
            $queryBuilder
                ->andWhere('c.usuario = :usuario')
                ->setParameter('usuario', $usuario);
        }
        // No puede ser dinámico el order
        if ($orden == 'ASC' ) {
            $queryBuilder
                ->orderBy('c.id', 'ASC');
        } else {
            $queryBuilder
                ->orderBy('c.id', 'DESC');
        }
        return $queryBuilder->getQuery()->getResult();
   }

//    public function findOneBySomeField($value): ?Compra
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }

//    /**
//     * @return Compra[] Returns an array of Compra objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('c.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

}
