<?php

namespace App\Services;

use App\Entity\Despesas;
use App\Entity\Receita;
use App\Entity\User;
use App\Helper\ArulaException;
use App\Services\Despesas\SetEntidadeDespesas;
use App\Services\Receita\SetEntidadeReceita;
use App\Services\Useres\SetEntidadeUser;
use DateTime;

class PopulaObjeto
{

    private $form;
    private $dados;
    public function __construct($form, $dados)
    {
        $this->form = $form;
        $this->dados = $dados;
    }
    public function getEntidade()
    {
        if ($this->form->entidade instanceof Receita) {
            $entidade =  new SetEntidadeReceita($this->form, $this->dados);
            return $entidade->set();
        }
        if ($this->form->entidade instanceof Despesas) {
            $entidade =  new SetEntidadeDespesas($this->form, $this->dados);
            return $entidade->set();
        }
        if ($this->form->entidade instanceof User) {
            $entidade =  new SetEntidadeUser($this->form, $this->dados);
            return $entidade->set();
        }
        throw new ArulaException('Tipo de entidade para populae não foi encontrato');
    }
}
