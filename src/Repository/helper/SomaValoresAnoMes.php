<?php

namespace App\Repository\helper;

use App\Helper\Metodo;

class SomaValoresAnoMes
{
    private int $ano;
    private int $mes;
    private $query;

    public function __construct($ano, $mes, $query)
    {
        $this->query = $query;
        $this->ano = $ano;
        $this->mes = $mes;
    }
    public function busca()
    {
        $alias = Metodo::entidade;
        $this->query
            ->select("YEAR({$alias}.data) as ano,
                     MONTH({$alias}.data) as mes,
                     sum({$alias}.valor) as valor")
            ->andWhere("YEAR({$alias}.data) = :ano")
            ->andWhere("MONTH({$alias}.data) = :mes")
            ->groupBy("ano, mes")
            ->setParameter('ano', $this->ano)
            ->setParameter('mes', $this->mes);
        return $this->query->getQuery()
            ->getArrayResult();
    }
}
