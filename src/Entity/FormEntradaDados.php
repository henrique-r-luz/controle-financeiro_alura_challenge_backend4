<?php

namespace App\Entity;

use App\Repository\ReceitaRepository;

class FormEntradaDados
{
    /**
     * Dados de entrada json
     *
     * @var string|null
     * @author Henrique Luz
     */
    public ?string $jsonDados;

    /**
     * parêmetro da rota
     *
     * @var integer|null
     * @author Henrique Luz
     */
    public ?int $id;

    /**
     * define a ação e inteção da operação
     *
     * @var string|null
     * @author Henrique Luz
     */
    public ?string $tipo;

    public ReceitaRepository $repositorio;
}
