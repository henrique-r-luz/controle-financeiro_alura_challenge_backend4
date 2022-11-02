<?php

namespace App\Services;

use App\Entity\Receita;
use App\Services\AnalisaJson;
use App\Services\LoadInterface;
use App\Entity\FormEntradaDados;

class LoadCreate implements LoadInterface
{
    private FormEntradaDados $form;

    public function __construct($form)
    {
        $this->form = $form;
    }

    public function getEntidade()
    {
        $analisaJson = new AnalisaJson($this->form);
        $dados = $analisaJson->getDados();
        $populaObjeto = new PopulaObjeto($this->form, $dados);
        return $populaObjeto->getEntidade();
    }
}
