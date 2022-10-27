<?php

namespace App\Services\Receita;

use DateTime;
use App\Helper\ArulaException;
use App\Entity\FormEntradaDados;

class LoadDelete implements LoadInterface
{
    private FormEntradaDados $form;

    public function __construct($form)
    {
        $this->form = $form;
    }
    public function getReceita()
    {
        $receita = $this->form->repositorio->findOneBy(['id' => $this->form->id]);
        if (empty($receita)) {
            throw new ArulaException("Recita não existe");
        }
        return $receita;
    }
}
