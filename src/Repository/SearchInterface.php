<?php

namespace App\Repository;

interface SearchInterface
{
    public function buscaDados(?string $descricao);
    public function buscaAnoMes(int $ano, int $mes);
    public function somaValoresAnoMes(int $ano, int $mes);
}
