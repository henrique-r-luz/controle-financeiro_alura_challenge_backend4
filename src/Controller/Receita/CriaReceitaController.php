<?php

namespace App\Controller\Receita;

use App\Helper\ArulaException;
use App\Services\ReceitaServices;
use PhpParser\ErrorHandler\Throwing;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Throwable;

class CriaReceitaController extends AbstractController
{
    #[Route('/receitas', name: 'app_receitas', methods: ['POST'])]
    public function cria(
        Request $request,
        ReceitaServices $receitaServices
    ): Response {
        try {
            $dados = json_decode($request->getContent(), true);
            if ($dados == null) {
                throw new ArulaException('O formato dos dados está incorreto.');
            }
            $receitaServices->load($dados);
            $receitaServices->save();
            return new JsonResponse(['Receita' => 1]);
        } catch (\Exception $e) {
            return new JsonResponse(['erro' => $e->getMessage()]);
        } catch (Throwable $e) {
            return new JsonResponse(['erro' => 'Um erro inesperado Ocorreu.' . $e->getMessage()]);
        }
    }
}
