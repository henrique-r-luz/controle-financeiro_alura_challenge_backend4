<?php

namespace App\Controller\Users;

use Throwable;
use App\Entity\User;
use App\Helper\Metodo;
use App\Entity\FormEntradaDados;
use App\Services\Useres\UserServices;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class UpdateController extends AbstractController
{
    #[Route('/users/{id}', methods: [Metodo::put])]
    public function update(
        Request $request,
        UserServices $userServices,
        int $id
    ): Response {
        try {
            $form = new FormEntradaDados();
            $form->tipo = Metodo::put;
            $form->entidade = new User();
            $form->jsonDados = $request->getContent();
            $form->id = $id;
            $userServices->load($form);
            $userServices->save();
            return new JsonResponse(['user' => 1]);
        } catch (\Exception $e) {
            return new JsonResponse(['erro' => $e->getMessage()], $status = 500);
        } catch (Throwable $e) {
            return new JsonResponse(['erro' => 'Um erro inesperado Ocorreu.' . $e->getMessage()], $status = 500);
        }
    }
}
