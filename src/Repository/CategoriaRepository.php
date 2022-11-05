<?php

namespace App\Repository;

use App\Helper\Metodo;
use App\Entity\Categoria;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

/**
 * @extends ServiceEntityRepository<Categoria>
 *
 * @method Categoria|null find($id, $lockMode = null, $lockVersion = null)
 * @method Categoria|null findOneBy(array $criteria, array $orderBy = null)
 * @method Categoria[]    findAll()
 * @method Categoria[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CategoriaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Categoria::class);
    }

    public function save(Categoria $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Categoria $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function somaPorAnoMes($ano, $mes)
    {
        $query  =  $this->createQueryBuilder('categoria')
            ->innerJoin('categoria.despesas', 'despesa')
            ->select("YEAR(despesa.data) as ano,
                      MONTH(despesa.data) as mes,
                      categoria.nome as categoria_nome,
                      sum(despesa.valor) as valor")

            ->groupBy("ano, mes, categoria_nome")
            ->andWhere("YEAR(despesa.data) = :ano")
            ->andWhere("MONTH(despesa.data) = :mes")
            ->setParameter('ano', $ano)
            ->setParameter('mes', $mes);
        return $query->getQuery()
            ->getArrayResult();
    }
}
