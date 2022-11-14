<?php

namespace App\Validacao\Receita;

use App\Entity\Receita;
use App\Repository\ReceitaRepository;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class ValidaReceitaFachada
{
    private ReceitaRepository $repositorio;
    private $receita;
    private ValidatorInterface $validator;

    public function __construct(
        ReceitaRepository $repositorio,
        Receita $receita,
        ValidatorInterface $validator
    ) {
        $this->repositorio = $repositorio;
        $this->receita = $receita;
        $this->validator = $validator;
    }


    public function valida()
    {
        $validaDescricaoMes = new ValidaDescricaoMes($this->repositorio, $this->receita);
        $validaDescricaoMes->valida();

        $validaEntidade =  new ValidaEntidade($this->validator, $this->receita);
        $validaEntidade->valida();
    }
}
