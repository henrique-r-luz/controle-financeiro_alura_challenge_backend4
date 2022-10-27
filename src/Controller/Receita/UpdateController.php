<?php

namespace App\Controller\Receita;

use App\Entity\FormEntradaDados;
use Throwable;
use App\Helper\ArulaException;
use App\Services\Receita\ReceitaServices;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class UpdateController extends AbstractController
{
    private const metodo = 'PUT';

    #[Route('/receitas/{id}', methods: [self::metodo])]
    public function update(
        Request $request,
        ReceitaServices $receitaServices,
        int $id
    ): Response {
        try {
            $form = new FormEntradaDados();
            $form->tipo = self::metodo;
            $form->jsonDados = $request->getContent();
            $form->id = $id;
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
