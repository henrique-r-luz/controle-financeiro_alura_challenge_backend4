<?php

namespace App\Controller\Receita;

use Throwable;
use App\Helper\Metodo;
use App\Entity\Receita;
use App\Entity\FormEntradaDados;
use App\Services\Receita\ReceitaServices;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Flex\Recipe;

class CriaReceitaController extends AbstractController
{

    #[Route('/receitas', name: 'app_receitas', methods: [Metodo::post])]
    public function cria(
        Request $request,
        ReceitaServices $receitaServices

    ): Response {
        try {
            $form = new FormEntradaDados();
            $form->tipo = Metodo::post;
            $form->entidade = new Receita();
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
