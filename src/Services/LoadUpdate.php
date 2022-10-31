<?php

namespace App\Services;


use App\Services\AnalisaJson;
use App\Helper\ArulaException;
use App\Services\LoadInterface;
use App\Entity\FormEntradaDados;

class LoadUpdate implements LoadInterface
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
        $entidade = $this->form->repositorio->findOneBy(['id' => $this->form->id]);
        if (empty($entidade)) {
            throw new ArulaException("Recita não existe");
        }
        $populaObjeto = new PopulaObjeto($entidade, $dados);
        return $populaObjeto->getEntidade();
    }
}
