<?php

namespace App\Repository;

use App\Helper\Metodo;
use App\Entity\Receita;
use App\Repository\helper\BuscaDados;
use App\Repository\helper\BusacaAnoMes;
use App\Validacao\DescricaoMesInterface;
use Doctrine\Persistence\ManagerRegistry;
use App\Repository\helper\SomaValoresAnoMes;
use App\Repository\helper\SearchDescricaoMes;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

/**
 * @extends ServiceEntityRepository<Receita>
 *
 * @method Receita|null find($id, $lockMode = null, $lockVersion = null)
 * @method Receita|null findOneBy(array $criteria, array $orderBy = null)
 * @method Receita[]    findAll()
 * @method Receita[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ReceitaRepository extends ServiceEntityRepository implements DescricaoMesInterface, SearchInterface
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

    public function searchDescricaoMes($receita)
    {
        $query  =  $this->createQueryBuilder(Metodo::entidade);
        $searchDescricaoMes = new SearchDescricaoMes(
            $receita,
            $query
        );
        return $searchDescricaoMes->busca();
    }


    public function buscaDados(?string $descricao)
    {
        $query  =  $this->createQueryBuilder(Metodo::entidade);
        $buscaDados = new BuscaDados($query, $descricao);
        return $buscaDados->busca();
    }

    public function buscaAnoMes(int $ano, int $mes)
    {
        $query  =  $this->createQueryBuilder(Metodo::entidade);
        $busacaAnoMes = new BusacaAnoMes($ano, $mes, $query);
        return $busacaAnoMes->busca();
    }


    public function somaValoresAnoMes(int $ano, int $mes)
    {
        $query  =  $this->createQueryBuilder(Metodo::entidade);
        $somaValoresAnoMes = new SomaValoresAnoMes($ano, $mes, $query);
        return $somaValoresAnoMes->busca();
    }
}
