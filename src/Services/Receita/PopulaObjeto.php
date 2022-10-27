<?php

namespace App\Services\Receita;

use DateTime;

class PopulaObjeto
{

    private $entidade;
    private $dados;
    public function __construct($entidade, $dados)
    {
        $this->entidade = $entidade;
        $this->dados = $dados;
    }
    public function getEntidade()
    {
        $this->entidade->setDescricao($this->dados[ReceitaServices::descricao])
            ->setValor($this->dados[ReceitaServices::valor])
            ->setData(new DateTime($this->dados[ReceitaServices::data]));
        return $this->entidade;
    }
}
