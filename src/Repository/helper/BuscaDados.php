<?php

namespace App\Repository\helper;

use App\Helper\Metodo;

class BuscaDados
{

    private $query;
    private ?string $descricao;

    public function __construct($query, ?string $descricao)
    {
        $this->query = $query;
        $this->descricao = $descricao;
    }

    public function busca()
    {
        $alias = Metodo::entidade;
        if ($this->descricao !== null) {
            $this->query->andWhere($this->query->expr()->like("{$alias}.descricao", ":descricao"))
                ->setParameter('descricao', '%' . $this->descricao . '%');
        }
        return $this->query->getQuery()->getResult();
    }
}
