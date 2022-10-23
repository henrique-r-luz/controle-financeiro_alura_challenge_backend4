<?php

namespace App\Controller;

use App\Entity\Receita;
use OpenApi\Attributes as OA;
use Nelmio\ApiDocBundle\Annotation\Model;
use PhpParser\Builder\Method;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ReceitaController extends AbstractController
{
    #[Route('/receitas', name: 'app_receitas', methods: ['POST'])]
    #[OA\Response(
        response: 200,
        description: 'Retorna uma Receita',
        content: new OA\JsonContent(
            type: 'object',
            //items: new OA\Items(ref: new Model(type: Receita::class, groups: ['full']))
        )
    )]
    #[OA\Parameter(
        name: 'Receita',
        in: 'query',
        required: true,
        #Method: 'POST',
        description: 'Cria uma nova receita',
        schema: new OA\Schema(type: 'object'),
    )]

    public function nova(Request $request): Response
    {
        // $post = $request->getContent();
        //return new JsonResponse(['ok' => 'ok']);
        $data = json_decode($request->getContent(), true);
        return new JsonResponse($data);
    }
}
