<?php

namespace App\Entity;

use App\Repository\ReceitaRepository;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

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

    /**
     * define o repositorio de qual entidade será 
     * usada
     * @var ServiceEntityRepository
     * @author Henrique Luz
     */
    public ServiceEntityRepository $repositorio;

    /**
     * define a entidade que sera tratada
     *
     * @var [type]
     * @author Henrique Luz
     */
    public $entidade;
}
