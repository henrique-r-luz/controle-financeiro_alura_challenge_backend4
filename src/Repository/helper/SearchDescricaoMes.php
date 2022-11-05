<?php

namespace App\Repository\helper;

use App\Helper\Metodo;
use PhpParser\Node\Stmt\TraitUseAdaptation\Alias;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\DBAL\Query\QueryBuilder;

class SearchDescricaoMes
{

    private $query;
    private $entidade;

    public function __construct($entidade, $query)
    {
        $this->query = $query;
        $this->entidade = $entidade;
    }

    public function busca()
    {
        $alias = Metodo::entidade;
        $query  = $this->query
            ->andWhere("{$alias}.descricao = :descricao")
            ->andWhere("MONTH({$alias}.data) = :mes")
            ->setParameter('descricao', $this->entidade->getDescricao())
            ->setParameter('mes', $this->entidade->getMes());
        if ($this->entidade->getId() != null) {
            $query->andWhere("{$alias}.id <> :id")
                ->setParameter('id', $this->entidade->getId());
        }
        return $query->getQuery()
            ->getResult();
    }
}
