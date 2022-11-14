<?php

namespace App\Controller\Users;

use Throwable;
use App\Entity\User;
use App\Helper\Metodo;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ListaUser extends AbstractController
{
    #[Route('/users', methods: [Metodo::get])]
    public function lista(
        ManagerRegistry $doctrine,
        Request $request
    ) {
        try {
            $descricao = $request->query->get('email') ?? null;
            /**@var UserRepository */
            $userRepositorio = $doctrine->getRepository(User::class);
            $user = $userRepositorio->buscaDados($descricao);
            return new JsonResponse($user);
        } catch (Throwable $e) {
            return new JsonResponse(
                ["erro" => "Um erro inesperado ocorreu!" . $e->getTraceAsString()],
                $status = 500
            );
        }
    }
}
