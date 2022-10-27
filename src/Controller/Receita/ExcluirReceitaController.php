<?php

namespace App\Controller\Receita;

use App\Entity\FormEntradaDados;
use Throwable;
use App\Helper\ArulaException;
use App\Services\Receita\ReceitaServices;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ExcluirReceitaController extends AbstractController
{

    private const metodo = 'DELETE';
    #[Route('/receitas/{id}', methods: [self::metodo])]
    public function delete(
        ReceitaServices $receitaServices,
        int $id
    ) {
        try {
            $form = new FormEntradaDados();
            $form->tipo = self::metodo;
            $form->id = $id;
            $receitaServices->load($form);
            $receitaServices->delete();
            return new JsonResponse(['Receita' => 1]);
        } catch (\Exception $e) {
            return new JsonResponse(['erro' => $e->getMessage()], $status = 500);
        } catch (Throwable $e) {
            return new JsonResponse(['erro' => 'Um erro inesperado Ocorreu.' . $e->getMessage()], $status = 500);
        }
    }
}
