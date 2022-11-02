<?php

namespace App\Services;

use App\Entity\Despesas;
use App\Entity\FormEntradaDados;
use App\Entity\Receita;
use App\Helper\ArulaException;
use App\Validacao\ValidaJson;

class AnalisaJson
{
    private  $form;

    public function __construct(FormEntradaDados $form)
    {
        $this->form = $form;
        $schema = $this->getSchema();
        ValidaJson::valida($this->form->jsonDados, $schema);
    }
    public function getDados()
    {
        return  \json_decode($this->form->jsonDados, true);
    }


    private function getSchema()
    {
        if ($this->form->entidade instanceof Receita) {
            return __DIR__ . '/../SchemasJson/receita_schema.json';
        }
        if ($this->form->entidade instanceof Despesas) {
            return __DIR__ . '/../SchemasJson/despesas_schema.json';
        }
        throw new ArulaException('Schema não implementado para entidade.');
    }
}
