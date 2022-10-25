<?php

namespace App\Validacao\Receita;

use App\Entity\Receita;
use App\Repository\ReceitaRepository;
use Doctrine\Persistence\ManagerRegistry;

class ValidaReceitaFachada
{
    private ReceitaRepository $repositorio;
    private $receita;

    public function __construct(ReceitaRepository $repositorio, Receita $receita)
    {
        $this->repositorio = $repositorio;
        $this->receita = $receita;
    }


    public function valida()
    {
        $validaDescricaoMes = new ValidaDescricaoMes($this->repositorio, $this->receita);
        $validaDescricaoMes->valida();
    }
}
