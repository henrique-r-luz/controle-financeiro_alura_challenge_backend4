<?php

namespace App\Controller\Receita;

use App\Entity\Receita;
use App\Helper\Metodo;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Throwable;

class ListaReceitasController extends AbstractController
{
    #[Route('/receitas', name: 'app_receitas_lista', methods: [Metodo::get])]
    public function lista(ManagerRegistry $doctrine)
    {
        try {
            $receitas = $doctrine->getRepository(Receita::class)->findAll();
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
