<?php

namespace App\Services;

use DateTime;
use KHerGe\JSON\JSON;
use App\Entity\Receita;
use App\Helper\ArulaException;
use App\Repository\ReceitaRepository;
use Doctrine\Persistence\ManagerRegistry;


class ReceitaServices
{

    const descricao = 'descricao';
    const valor = 'valor';
    const data = 'data';

    private Receita $receita;
    private ManagerRegistry $doctrine;


    public function __construct(ManagerRegistry $doctrine)
    {
        $this->receita = new Receita($doctrine);
        $this->doctrine = $doctrine;
    }


    public function load($jsonDados)
    {
        $this->validaEntrada($jsonDados);
        $dados = \json_decode($jsonDados, true);
        $this->receita->setDescricao($dados[self::descricao])
            ->setValor($dados[self::valor])
            ->setData(new DateTime($dados[self::data]));
    }

    private function validaEntrada($jsonDados)
    {
        $json = new JSON();
        $decoded = $json->decode($jsonDados);
        $schema = $json->decodeFile(__DIR__ . '/../SchemasJson/receita_schema.json');
        $json->validate(
            $schema,
            $decoded
        );
        return $decoded;
    }

    public function save()
    {
        /**@var ReceitaRepository */
        $repositorio = $this->doctrine->getRepository(Receita::class);
        $repositorio->save($this->receita, true);
    }
}
