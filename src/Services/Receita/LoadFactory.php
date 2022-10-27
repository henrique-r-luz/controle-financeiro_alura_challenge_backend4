<?php

namespace App\Services\Receita;

use App\Entity\FormEntradaDados;


class LoadFactory
{
    public static function getObject(FormEntradaDados $form)
    {
        switch ($form->tipo) {
            case 'POST':
                return new LoadCreate($form);
            case 'PUT':
                return new LoadUpdate($form);
            case 'DELETE':
                return new LoadDelete($form);
        }
    }
}
