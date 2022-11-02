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
        $this->form->entidade = $this->form->repositorio->findOneBy(['id' => $this->form->id]);
        if (empty($this->form->entidade)) {
            throw new ArulaException("Entidade não existe");
        }
        $populaObjeto = new PopulaObjeto($this->form, $dados);
        return $populaObjeto->getEntidade();
    }
}
