<?php

namespace App\Controller\Despesa;

use Throwable;
use App\Helper\Metodo;
use App\Entity\Despesas;
use App\Repository\DespesasRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class ListaDespesasController extends AbstractController
{
    #[Route('/despesas', methods: [Metodo::get])]
    public function lista(
        ManagerRegistry $doctrine,
        Request $request
    ) {
        try {
            $descricao = $request->query->get('descricao') ?? null;
            /**@var DespesasRepository */
            $despesaRepositorio = $doctrine->getRepository(Despesas::class);
            $despesas = $despesaRepositorio->buscaDados($descricao);
            return new JsonResponse($despesas);
        } catch (Throwable $e) {
            return new JsonResponse(
                ["erro" => "Um erro inesperado ocorreu!" . $e->getTraceAsString()],
                $status = 500
            );
        }
    }


    #[Route('/despesas/{id}', methods: [Metodo::get])]
    public function listaOne(ManagerRegistry $doctrine, int $id)
    {
        try {
            $despesas = $doctrine->getRepository(Despesas::class)->findBy(['id' => $id]);
            return new JsonResponse($despesas);
        } catch (Throwable $e) {
            return new JsonResponse(["erro" => "Um erro inesperado ocorreu!"], $status = 500);
        }
    }

    #[Route('/despesas/{ano}/{mes}', methods: [Metodo::get])]
    public function listaAnomeMes(ManagerRegistry $doctrine, int $ano, int $mes)
    {
        try {
            /**@var  ReceitaRepository */
            $receitaRepositorio = $doctrine->getRepository(Despesas::class);
            $despesas = $receitaRepositorio->buscaAnoMes($ano, $mes);
            return new JsonResponse($despesas);
        } catch (Throwable $e) {
            return new JsonResponse(["erro" => "Um erro inesperado ocorreu!"], $status = 500);
        }
    }
}
