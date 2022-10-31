<?php

namespace App\Validacao\Despesas;


use App\Entity\Despesas;
use App\Repository\DespesasRepository;
use App\Validacao\Receita\ValidaDescricaoMes;

class ValidaDespesaFachada
{
    private DespesasRepository $repositorio;
    private $despesa;

    public function __construct(DespesasRepository $repositorio, Despesas $despesa)
    {
        $this->repositorio = $repositorio;
        $this->despesa = $despesa;
    }


    public function valida()
    {
        $validaDescricaoMes = new ValidaDescricaoMes($this->repositorio, $this->despesa);
        $validaDescricaoMes->valida();
    }
}
