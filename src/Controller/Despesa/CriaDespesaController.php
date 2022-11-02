<?php

namespace App\Controller\Despesa;

use Throwable;
use App\Helper\Metodo;
use App\Entity\Despesas;
use App\Entity\FormEntradaDados;
use App\Services\Despesas\DespesasServices;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CriaDespesaController extends AbstractController
{
    #[Route('/despesas', methods: [Metodo::post])]
    public function cria(
        Request $request,
        DespesasServices $despesasServices

    ): Response {
        try {
            $form = new FormEntradaDados();
            $form->tipo = Metodo::post;
            $form->entidade = new Despesas();
            $form->jsonDados = $request->getContent();
            $despesasServices->load($form);
            $despesasServices->save();
            return new JsonResponse(['Despesa' => 1]);
        } catch (\Exception $e) {
            return new JsonResponse(['erro' => $e->getMessage()], $status = 500);
        } catch (Throwable $e) {
            return new JsonResponse(['erro' => 'Um erro inesperado Ocorreu.' . $e->getTraceAsString()], $status = 500);
        }
    }
}
