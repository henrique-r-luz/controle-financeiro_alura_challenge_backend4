<?php

namespace App\Services;

use App\Entity\FormEntradaDados;
use App\Validacao\ValidaJson;

class AnalisaJson
{
    private  $form;

    public function __construct(FormEntradaDados $form)
    {
        $this->form = $form;
        $schema = __DIR__ . '/../SchemasJson/receita_schema.json';
        ValidaJson::valida($this->form->jsonDados, $schema);
    }
    public function getDados()
    {
        return  \json_decode($this->form->jsonDados, true);
    }
}
