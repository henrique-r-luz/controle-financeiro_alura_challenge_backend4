<?php

namespace App\Services\Despesas;


use App\Entity\Despesas;
use App\Services\LoadFactory;
use App\Entity\FormEntradaDados;
use App\Repository\DespesasRepository;
use Doctrine\Persistence\ManagerRegistry;
use App\Validacao\Despesas\ValidaDespesaFachada;


class DespesasServices
{


    private Despesas $despesas;
    private ManagerRegistry $doctrine;
    private DespesasRepository $repositorio;


    public function __construct(ManagerRegistry $doctrine)
    {
        $this->despesas = new Despesas();
        $this->doctrine = $doctrine;
        $this->repositorio = $this->doctrine->getRepository(Despesas::class);
    }


    public function load(FormEntradaDados $form)
    {

        $form->repositorio = $this->repositorio;
        
        /**@var LoadInterface */
        $load = LoadFactory::getObject($form);
        $this->despesas = $load->getEntidade();
    }



    public function save()
    {

        $validaDespesaFachada = new ValidaDespesaFachada($this->repositorio, $this->despesas);
        $validaDespesaFachada->valida();
        $this->repositorio->save($this->despesas, true);
    }


    public function delete()
    {
        $this->repositorio->remove($this->despesas, true);
    }
}
