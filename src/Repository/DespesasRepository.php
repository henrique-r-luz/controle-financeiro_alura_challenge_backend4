<?php

namespace App\Repository;

use App\Entity\Despesas;
use App\Validacao\DescricaoMesInterface;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

/**
 * @extends ServiceEntityRepository<Despesas>
 *
 * @method Despesas|null find($id, $lockMode = null, $lockVersion = null)
 * @method Despesas|null findOneBy(array $criteria, array $orderBy = null)
 * @method Despesas[]    findAll()
 * @method Despesas[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DespesasRepository extends ServiceEntityRepository implements DescricaoMesInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Despesas::class);
    }

    public function save(Despesas $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Despesas $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function searchDescricaoMes($despesa)
    {
        $query  =  $this->createQueryBuilder('despesa')
            ->andWhere('despesa.descricao = :descricao')
            ->andWhere('MONTH(despesa.data) = :mes')
            ->setParameter('descricao', $despesa->getDescricao())
            ->setParameter('mes', $despesa->getMes());
        if ($despesa->getId() != null) {
            $query->andWhere('despesa.id <> :id')
                ->setParameter('id', $despesa->getId());
        }
        return $query->getQuery()
            ->getResult();
    }

    //    /**
    //     * @return Despesas[] Returns an array of Despesas objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('d')
    //            ->andWhere('d.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('d.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Despesas
    //    {
    //        return $this->createQueryBuilder('d')
    //            ->andWhere('d.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
