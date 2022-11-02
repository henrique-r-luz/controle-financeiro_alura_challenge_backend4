<?php

namespace App\Controller\Despesa;

use App\Entity\Despesas;
use Throwable;
use App\Helper\Metodo;
use App\Entity\FormEntradaDados;
use App\Services\Despesas\DespesasServices;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class UpdateController extends AbstractController
{
    #[Route('/despesas/{id}', methods: [Metodo::put])]
    public function update(
        Request $request,
        DespesasServices $despesasServices,
        int $id
    ): Response {
        try {
            $form = new FormEntradaDados();
            $form->tipo = Metodo::put;
            $form->entidade = new Despesas();
            $form->jsonDados = $request->getContent();
            $form->id = $id;
            $despesasServices->load($form);
            $despesasServices->save();
            return new JsonResponse(['Despesas' => 1]);
        } catch (\Exception $e) {
            return new JsonResponse(['erro' => $e->getMessage()], $status = 500);
        } catch (Throwable $e) {
            return new JsonResponse(['erro' => 'Um erro inesperado Ocorreu.' . $e->getMessage()], $status = 500);
        }
    }
}
