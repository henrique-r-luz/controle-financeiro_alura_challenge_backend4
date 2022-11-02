<?php

namespace App\Controller\Despesa;

use Throwable;
use App\Helper\Metodo;
use App\Entity\Despesas;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;

class ListaDespesasController extends AbstractController
{
    #[Route('/despesas', methods: [Metodo::get])]
    public function lista(ManagerRegistry $doctrine)
    {
        try {
            $despesas = $doctrine->getRepository(Despesas::class)->findAll();
            return new JsonResponse($despesas);
        } catch (Throwable $e) {
            return new JsonResponse(["erro" => "Um erro inesperado ocorreu!" . $e->getTraceAsString()], $status = 500);
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
}
