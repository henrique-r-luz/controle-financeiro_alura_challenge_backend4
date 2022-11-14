<?php

namespace App\Validacao\Despesas;


use App\Entity\Despesas;
use App\Repository\DespesasRepository;
use App\Validacao\Receita\ValidaEntidade;
use App\Validacao\Receita\ValidaDescricaoMes;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class ValidaDespesaFachada
{
    private DespesasRepository $repositorio;
    private $despesa;
    private ValidatorInterface $validator;

    public function __construct(
        DespesasRepository $repositorio,
        Despesas $despesa,
        ValidatorInterface $validator
    ) {
        $this->repositorio = $repositorio;
        $this->despesa = $despesa;
        $this->validator = $validator;
    }


    public function valida()
    {
        $validaDescricaoMes = new ValidaDescricaoMes($this->repositorio, $this->despesa);
        $validaDescricaoMes->valida();

        $validaEntidade =  new ValidaEntidade($this->validator, $this->despesa);
        $validaEntidade->valida();
    }
}
