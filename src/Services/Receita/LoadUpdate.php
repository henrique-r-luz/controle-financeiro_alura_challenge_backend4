<?php

namespace App\Services\Receita;

use DateTime;
use App\Helper\ArulaException;
use App\Entity\FormEntradaDados;
use App\Validacao\Receita\ValidaJson;

class LoadUpdate implements LoadInterface
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
        $receita = $this->form->repositorio->findOneBy(['id' => $this->form->id]);
        if (empty($receita)) {
            throw new ArulaException("Recita não existe");
        }
        $receita->setDescricao($dados[ReceitaServices::descricao])
            ->setValor($dados[ReceitaServices::valor])
            ->setData(new DateTime($dados[ReceitaServices::data]));

        return $receita;
    }
}
