<?php

namespace App\Services\Receita;

use DateTime;
use App\Entity\FormEntradaDados;
use App\Entity\Receita;
use App\Validacao\Receita\ValidaJson;

class LoadCreate implements LoadInterface
{
    private FormEntradaDados $form;

    public function __construct($form)
    {
        $this->form = $form;
    }

    public function getReceita()
    {
        $schema = __DIR__ . '/../../SchemasJson/receita_schema.json';
        ValidaJson::valida($this->form->jsonDados, $schema);
        $dados = \json_decode($this->form->jsonDados, true);
        $receita = new Receita();
        $populaObjeto = new PopulaObjeto($receita, $dados);
        return $populaObjeto->getEntidade();
    }
}
