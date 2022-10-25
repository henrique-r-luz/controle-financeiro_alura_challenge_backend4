<?php

namespace App\Controller\Receita;

use Throwable;
use App\Helper\ArulaException;
use App\Services\ReceitaServices;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class UpdateController extends AbstractController
{

    #[Route('/receitas/{id}', methods: ['PUT'])]
    public function cria(
        Request $request,
        ReceitaServices $receitaServices,
        int $id
    ): Response {
        try {
            $dados = $request->getContent();
            if ($dados == null) {
                throw new ArulaException('O formato dos dados está incorreto.');
            }
            $receitaServices->updateLoad($dados, $id);
            $receitaServices->save();
            return new JsonResponse(['Receita' => 1]);
        } catch (\Exception $e) {
            return new JsonResponse(['erro' => $e->getMessage()], $status = 500);
        } catch (Throwable $e) {
            return new JsonResponse(['erro' => 'Um erro inesperado Ocorreu.' . $e->getMessage()], $status = 500);
        }
    }
}
