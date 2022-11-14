<?php

namespace App\Controller\Users;

use Throwable;
use App\Helper\Metodo;
use App\Entity\FormEntradaDados;
use App\Services\Useres\UserServices;
use App\Services\Despesas\DespesasServices;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ExcluirUser extends AbstractController
{
    #[Route('/users/{id}', methods: [Metodo::delete])]
    public function delete(
        UserServices $userServices,
        int $id
    ) {
        try {
            $form = new FormEntradaDados();
            $form->tipo = Metodo::delete;
            $form->id = $id;
            $userServices->load($form);
            $userServices->delete();
            return new JsonResponse(['User' => 1]);
        } catch (\Exception $e) {
            return new JsonResponse(['erro' => $e->getMessage()], $status = 500);
        } catch (Throwable $e) {
            return new JsonResponse(['erro' => 'Um erro inesperado Ocorreu.' . $e->getMessage()], $status = 500);
        }
    }
}
