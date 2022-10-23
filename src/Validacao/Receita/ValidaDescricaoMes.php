<?php

namespace App\Validacao\Receita;

use App\Entity\Receita;
use App\Helper\ArulaException;
use App\Repository\ReceitaRepository;
use App\Validacao\ValidaInterface;

class ValidaDescricaoMes implements ValidaInterface
{

    private $receita;

    public function __construct(Receita $receita)
    {
        $this->receita = $receita;
    }

    public function valida()
    {
        /**@var ReceitaRepository */
        $repositorio = $this->receita->doctrine->getRepository(Receita::class);
        $resp = $repositorio->searchDescricaoMes($this->receita);
        if (!empty($resp)) {
            throw new ArulaException('A descrição já foi inserida no mês:' . $this->receita->getMes());
        }
    }
}
