<?php

namespace App\Services\Despesas;

use DateTime;
use App\Entity\Despesas;
use App\Entity\Categoria;
use App\Helper\ArulaException;
use App\Entity\FormEntradaDados;
use App\Services\SetEntidadeInterface;
use Doctrine\Persistence\ManagerRegistry;

class SetEntidadeDespesas implements SetEntidadeInterface
{
    const descricao = 'descricao';
    const valor = 'valor';
    const data = 'data';
    const categoria = 'categoria';

    private Despesas $entidade;
    private $dados;
    private ManagerRegistry $doctrine;

    public function __construct(FormEntradaDados $form, $dados)
    {
        $this->entidade = $form->entidade;
        $this->dados = $dados;
        $this->doctrine = $form->repositorio->registry;
    }

    public function set()
    {
        if (isset($this->dados[self::categoria])) {
            $categoria =  $this->doctrine->getRepository(Categoria::class)->findOneBy(['nome' => $this->dados[self::categoria]]);
            if (empty($categoria)) {
                throw new ArulaException('A categoria não foi encontrada!');
            }
        } else {
            $categoria =  $this->doctrine->getRepository(Categoria::class)->findOneBy(['nome' => Categoria::Outras]);
        }

        $this->entidade->setDescricao($this->dados[self::descricao])
            ->setValor($this->dados[self::valor])
            ->setData(new DateTime($this->dados[self::data]))
            ->setCategoria($categoria);

        return $this->entidade;
    }
}
