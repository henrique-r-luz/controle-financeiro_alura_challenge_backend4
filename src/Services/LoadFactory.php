<?php

namespace App\Services;

use App\Entity\FormEntradaDados;
use App\Helper\Metodo;

class LoadFactory
{
    public static function getObject(FormEntradaDados $form)
    {
        switch ($form->tipo) {
            case Metodo::post:
                return new LoadCreate($form);
            case Metodo::put:
                return new LoadUpdate($form);
            case Metodo::delete:
                return new LoadDelete($form);
        }
    }
}
