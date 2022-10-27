<?php

namespace App\Validacao\Receita;

use KHerGe\JSON\JSON;

class ValidaJson
{

    public static  function valida($jsonData, $schema)
    {
        $json = new JSON();
        $decoded = $json->decode($jsonData);
        $schema = $json->decodeFile($schema);
        $json->validate(
            $schema,
            $decoded
        );
    }
}
