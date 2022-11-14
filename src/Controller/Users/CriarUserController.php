<?php

namespace App\Controller\Users;

use Throwable;
use App\Entity\User;
use App\Helper\Metodo;
use App\Entity\FormEntradaDados;
use App\Services\Useres\UserServices;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CriarUserController extends AbstractController
{
    #[Route('/users', methods: [Metodo::post])]
    public function criar(
        Request $request,
        UserServices $userServices
    ) {
        try {
            $form = new FormEntradaDados();
            $form->tipo = Metodo::post;
            $form->entidade = new User();
            $form->jsonDados = $request->getContent();
            $userServices->load($form);
            $userServices->save();
            return new JsonResponse(['User' => 1]);
        } catch (\Exception $e) {
            return new JsonResponse(['erro' => $e->getMessage()], $status = 500);
        } catch (Throwable $e) {
            return new JsonResponse(['erro' => 'Um erro inesperado Ocorreu.' . $e->getTraceAsString()], $status = 500);
        }
    }
}
