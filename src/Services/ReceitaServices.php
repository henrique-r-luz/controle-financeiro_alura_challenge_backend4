<?php

namespace App\Services;

use DateTime;
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

    private $atributos = [
        'descricao' => 'descricao',
        'valor' => 'valor',
        'data' => 'data'
    ];

    public function __construct(ManagerRegistry $doctrine)
    {
        $this->receita = new Receita($doctrine);
        $this->doctrine = $doctrine;
    }


    public function load(array $dados)
    {
        $this->validaEntrada($dados);
        $this->receita->setDescricao($dados[self::descricao])
            ->setValor($dados[self::valor])
            ->setData(new DateTime($dados[self::data]));
    }

    private function validaEntrada(array $dados)
    {
        $atributosFaltando = array_diff_key($this->atributos, $dados);
        if (!empty($atributosFaltando)) {
            $itens = '';
            $index = 0;
            foreach ($atributosFaltando as $atributo => $atri) {
                if ($index == 0) {
                    $itens .= "'" . $atributo . "'";
                } else {
                    $itens .= ", '" . $atributo . "'";
                }
                $index++;
            }
            throw new  ArulaException("Os atributos " . $itens . " não foram enviados");
        }
    }

    public function save()
    {
        /**@var ReceitaRepository */
        $repositorio = $this->doctrine->getRepository(Receita::class);
        $repositorio->save($this->receita, true);
    }
}
