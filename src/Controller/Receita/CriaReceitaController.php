<?php

namespace App\Controller\Receita;

use App\Entity\FormEntradaDados;
use Throwable;
use App\Services\Receita\ReceitaServices;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CriaReceitaController extends AbstractController
{
    private  const   metodo = 'POST';

    #[Route('/receitas', name: 'app_receitas', methods: [self::metodo])]
    public function cria(
        Request $request,
        ReceitaServices $receitaServices

    ): Response {
        try {
            $form = new FormEntradaDados();
            $form->tipo = self::metodo;
            $form->jsonDados = $request->getContent();
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
