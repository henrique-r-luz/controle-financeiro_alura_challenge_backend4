<?php

namespace App\Controller\Receita;

use Throwable;
use App\Helper\Metodo;
use App\Entity\Receita;
use App\Repository\ReceitaRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ListaReceitasController extends AbstractController
{
    #[Route('/receitas', methods: [Metodo::get])]
    public function lista(
        ManagerRegistry $doctrine,
        Request $request
    ) {
        try {
            $descricao = $request->query->get('descricao') ?? null;
            /**@var  ReceitaRepository */
            $receitaRepositorio = $doctrine->getRepository(Receita::class);
            $receitas = $receitaRepositorio->buscaReceitas($descricao);
            return new JsonResponse($receitas);
        } catch (Throwable $e) {
            return new JsonResponse(["erro" => "Um erro inesperado ocorreu!"], $status = 500);
        }
    }


    #[Route('/receitas/{id}', methods: [Metodo::get])]
    public function listaOne(ManagerRegistry $doctrine, int $id)
    {
        try {
            $receitas = $doctrine->getRepository(Receita::class)->findBy(['id' => $id]);
            return new JsonResponse($receitas);
        } catch (Throwable $e) {
            return new JsonResponse(["erro" => "Um erro inesperado ocorreu!"], $status = 500);
        }
    }
}
