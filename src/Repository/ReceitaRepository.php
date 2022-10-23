<?php

namespace App\Repository;

use App\Entity\Receita;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Receita>
 *
 * @method Receita|null find($id, $lockMode = null, $lockVersion = null)
 * @method Receita|null findOneBy(array $criteria, array $orderBy = null)
 * @method Receita[]    findAll()
 * @method Receita[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ReceitaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Receita::class);
    }

    public function save(Receita $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Receita $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function searchDescricaoMes(Receita $receita)
    {
        return $this->createQueryBuilder('receita')
            ->andWhere('receita.descricao = :descricao')
            ->andWhere('MONTH(receita.data) = :mes')
            ->setParameter('descricao', $receita->getDescricao())
            ->setParameter('mes', $receita->getMes())
            ->getQuery()
            ->getResult();
    }

    //    /**
    //     * @return Receita[] Returns an array of Receita objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('r')
    //            ->andWhere('r.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('r.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Receita
    //    {
    //        return $this->createQueryBuilder('r')
    //            ->andWhere('r.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
