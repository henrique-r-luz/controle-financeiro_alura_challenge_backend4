<?php

namespace App\Services;

use DateTime;

class PopulaObjeto
{
    const descricao = 'descricao';
    const valor = 'valor';
    const data = 'data';

    private $entidade;
    private $dados;
    public function __construct($entidade, $dados)
    {
        $this->entidade = $entidade;
        $this->dados = $dados;
    }
    public function getEntidade()
    {
        $this->entidade->setDescricao($this->dados[self::descricao])
            ->setValor($this->dados[self::valor])
            ->setData(new DateTime($this->dados[self::data]));
        return $this->entidade;
    }
}
