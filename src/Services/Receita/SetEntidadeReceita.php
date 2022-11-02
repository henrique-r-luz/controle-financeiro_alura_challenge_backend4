<?php

namespace App\Services\Receita;

use App\Entity\FormEntradaDados;
use DateTime;
use App\Entity\Receita;
use App\Services\SetEntidadeInterface;

class SetEntidadeReceita implements SetEntidadeInterface
{
    const descricao = 'descricao';
    const valor = 'valor';
    const data = 'data';

    private Receita $entidade;
    private $dados;

    public function __construct(FormEntradaDados $form, $dados)
    {
        $this->entidade = $form->entidade;
        $this->dados = $dados;
    }

    public function set()
    {
        $this->entidade->setDescricao($this->dados[self::descricao])
            ->setValor($this->dados[self::valor])
            ->setData(new DateTime($this->dados[self::data]));
        return $this->entidade;
    }
}
