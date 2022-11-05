<?php

namespace App\Repository\helper;

use App\Helper\Metodo;

class BusacaAnoMes
{

    private int $ano;
    private int $mes;
    private $query;

    public function __construct(int $ano, int $mes, $query)
    {
        $this->ano = $ano;
        $this->mes = $mes;
        $this->query = $query;
    }

    public function busca()
    {
        $alias = Metodo::entidade;
        $this->query
            ->andWhere("YEAR({$alias}.data) = :ano")
            ->andWhere("MONTH({$alias}.data) = :mes")
            ->setParameter('ano', $this->ano)
            ->setParameter('mes', $this->mes);
        return $this->query->getQuery()
            ->getResult();
    }
}
