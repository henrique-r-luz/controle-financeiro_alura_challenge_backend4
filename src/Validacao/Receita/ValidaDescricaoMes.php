<?php

namespace App\Validacao\Receita;

use App\Entity\Receita;
use App\Helper\ArulaException;
use App\Validacao\ValidaInterface;
use App\Repository\ReceitaRepository;

class ValidaDescricaoMes implements ValidaInterface
{

    private $receita;
    private $repositorio;

    public function __construct($repositorio, $receita)
    {
        $this->receita = $receita;
        $this->repositorio = $repositorio;
    }

    public function valida()
    {
        $resp = $this->repositorio->searchDescricaoMes($this->receita);
        if (!empty($resp)) {
            throw new ArulaException('A descrição já foi inserida no mês:' . $this->receita->getMes());
        }
    }
}
