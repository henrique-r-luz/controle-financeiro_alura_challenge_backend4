<?php

namespace App\Repository;

use App\Entity\Categoria;
use App\Entity\Receita;
use App\Entity\Despesas;
use App\Repository\ReceitaRepository;
use App\Repository\DespesasRepository;
use Doctrine\Persistence\ManagerRegistry;

class ResumoMes
{
    private int $ano;
    private int $mes;
    private ManagerRegistry $doctrine;


    public function __construct(int $ano, int $mes, ManagerRegistry $doctrine)
    {
        $this->ano = $ano;
        $this->mes = $mes;
        $this->doctrine = $doctrine;
    }

    private function totalRecitas()
    {
        /**@var ReceitaRepository */
        $repositorio =  $this->doctrine->getRepository(Receita::class);
        $totalReceita =  $repositorio->somaValoresAnoMes($this->ano, $this->mes);
        $valorReceita = 0;
        if (!empty($totalReceita)) {
            $valorReceita = $totalReceita[0]['valor'];
        }
        return (float) $valorReceita;
    }

    private function totalDespesas()
    {
        /**@var DespesasRepository */
        $repositorio =  $this->doctrine->getRepository(Despesas::class);
        $totalDespesa =  $repositorio->somaValoresAnoMes($this->ano, $this->mes);
        $valorDespesas = 0;
        if (!empty($totalDespesa)) {
            $valorDespesas = $totalDespesa[0]['valor'];
        }
        return (float) $valorDespesas;
    }

    private function categoriaMes()
    {
        /**@var CategoriaRepository */
        $repositorio =  $this->doctrine->getRepository(Categoria::class);
        $categosrias = $repositorio->somaPorAnoMes($this->ano, $this->mes);
        $somaCategorias = [];
        foreach ($categosrias as $categoria) {
            $somaCategorias[] = ['nome' => $categoria['categoria_nome'], 'valor' => $categoria['valor']];
        }
        return $somaCategorias;
    }


    public function busca()
    {

        $receita = $this->totalRecitas();
        $despesa = $this->totalDespesas();
        $retorno  = [];
        $retorno['ano'] = $this->ano;
        $retorno['mes'] = $this->mes;
        $retorno['total_despesas'] = $despesa;
        $retorno['total_receita'] = $receita;
        $retorno['saldo_mes'] =  ($receita  -  $despesa);
        $retorno['categorias'] = $this->categoriaMes();

        return $retorno;
    }
}
