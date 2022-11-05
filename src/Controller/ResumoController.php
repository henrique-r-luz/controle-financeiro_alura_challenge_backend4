<?php

namespace App\Controller;

use Throwable;
use App\Helper\Metodo;
use App\Entity\Despesas;
use App\Repository\ResumoMes;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ResumoController extends AbstractController
{
    #[Route('/resumo/{ano}/{mes}', methods: [Metodo::get])]
    public function listaAnomeMes(ManagerRegistry $doctrine, int $ano, int $mes)
    {
        try {
            $resumoMes = new ResumoMes($ano, $mes, $doctrine);
            return new JsonResponse($resumoMes->busca());
        } catch (Throwable $e) {
            return new JsonResponse(["erro" => "Um erro inesperado ocorreu!" . $e->getMessage()], $status = 500);
        }
    }
}
