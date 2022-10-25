<?php

namespace App\Services;

use DateTime;
use KHerGe\JSON\JSON;
use App\Entity\Receita;
use App\Helper\ArulaException;
use App\Repository\ReceitaRepository;
use Doctrine\Persistence\ManagerRegistry;
use App\Validacao\Receita\ValidaReceitaFachada;


class ReceitaServices
{

    const descricao = 'descricao';
    const valor = 'valor';
    const data = 'data';

    private Receita $receita;
    private ManagerRegistry $doctrine;
    private ReceitaRepository $repositorio;


    public function __construct(ManagerRegistry $doctrine)
    {
        $this->receita = new Receita();
        $this->doctrine = $doctrine;
        $this->repositorio = $this->doctrine->getRepository(Receita::class);
    }


    public function load($jsonDados)
    {
        $this->validaEntrada($jsonDados);
        $dados = \json_decode($jsonDados, true);
        $this->receita->setDescricao($dados[self::descricao])
            ->setValor($dados[self::valor])
            ->setData(new DateTime($dados[self::data]));
    }

    public function updateLoad($jsonDados, int $id)
    {
        $this->validaEntrada($jsonDados);

        $dados = \json_decode($jsonDados, true);

        /**@var Receita */
        $this->receita = $this->repositorio->findOneBy(['id' => $id]);
        if (empty($this->receita)) {
            throw new ArulaException("Recita não existe");
        }

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

        $validaReceitaFachada = new ValidaReceitaFachada($this->repositorio, $this->receita);
        $validaReceitaFachada->valida();
        $this->repositorio->save($this->receita, true);
    }
}
