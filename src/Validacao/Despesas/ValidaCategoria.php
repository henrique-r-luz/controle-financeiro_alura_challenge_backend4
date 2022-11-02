<?php

namespace App\Validacao\Despesas;

use App\Helper\ArulaException;
use App\Validacao\ValidaInterface;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Persistence\AbstractManagerRegistry;

class ValidaCategoria extends AbstractManagerRegistry implements ValidaInterface
{

    private $despesas;
    private $repositorio;
    private ManagerRegistry $doctrine;

    public function __construct($repositorio, $despesas)
    {
        $this->despesas = $despesas;
        $this->repositorio = $repositorio;
        $this->doctrine = $repositorio->registry;
    }


    public function valida()
    {
        //$repositoryCategoria = $this->doctrine->getRepository(Categoria::class)
        //->findOneBy(['nome'=>$this->despesas->get]);
        /* $resp = $this->repositorio->searchDescricaoMes($this->receita);
        if (!empty($resp)) {
            throw new ArulaException('A descrição já foi inserida no mês:' . $this->receita->getMes());
        }*/
    }

    protected function getService(string $name)
    {
    }

    /**
     * Resets the given services.
     *
     * A service in this context is connection or a manager instance.
     *
     * @param string $name The name of the service.
     *
     * @return void
     */
    protected function resetService(string $name)
    {
    }
}
