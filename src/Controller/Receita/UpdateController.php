<?php

namespace App\Controller\Receita;

use App\Entity\FormEntradaDados;
use App\Entity\Receita;
use Throwable;
use App\Helper\Metodo;
use App\Services\Receita\ReceitaServices;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class UpdateController extends AbstractController
{

    #[Route('/receitas/{id}', methods: [Metodo::put])]
    public function update(
        Request $request,
        ReceitaServices $receitaServices,
        int $id
    ): Response {
        try {
            $form = new FormEntradaDados();
            $form->tipo = Metodo::put;
            $form->entidade = new Receita;
            $form->jsonDados = $request->getContent();
            $form->id = $id;
            $receitaServices->load($form);
            $receitaServices->save();
            return new JsonResponse(['Receita' => 1]);
        } catch (\Exception $e) {
            return new JsonResponse(['erro' => $e->getMessage()], $status = 500);
        } catch (Throwable $e) {
            return new JsonResponse(['erro' => 'Um erro inesperado Ocorreu.' . $e->getMessage()], $status = 500);
        }
    }
}
