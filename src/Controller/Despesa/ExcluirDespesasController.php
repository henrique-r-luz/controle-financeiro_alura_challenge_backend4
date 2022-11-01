<?php

namespace App\Controller\Despesa;

use Throwable;
use App\Helper\Metodo;
use App\Entity\FormEntradaDados;
use App\Services\Despesas\DespesasServices;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ExcluirDespesasController extends AbstractController
{

    #[Route('/despesas/{id}', methods: [Metodo::delete])]
    public function delete(
        DespesasServices $despesasServices,
        int $id
    ) {
        try {
            $form = new FormEntradaDados();
            $form->tipo = Metodo::delete;
            $form->id = $id;
            $despesasServices->load($form);
            $despesasServices->delete();
            return new JsonResponse(['Despesas' => 1]);
        } catch (\Exception $e) {
            return new JsonResponse(['erro' => $e->getMessage()], $status = 500);
        } catch (Throwable $e) {
            return new JsonResponse(['erro' => 'Um erro inesperado Ocorreu.' . $e->getMessage()], $status = 500);
        }
    }
}
