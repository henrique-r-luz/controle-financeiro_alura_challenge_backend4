<?php

namespace App\Services\Despesas;


use App\Entity\Despesas;
use App\Services\LoadFactory;
use App\Entity\FormEntradaDados;
use App\Repository\DespesasRepository;
use Doctrine\Persistence\ManagerRegistry;
use App\Validacao\Despesas\ValidaDespesaFachada;
use Symfony\Component\Validator\Validator\ValidatorInterface;


class DespesasServices
{


    private Despesas $despesas;
    private ManagerRegistry $doctrine;
    private DespesasRepository $repositorio;
    private VALIDATORINTERFACE $validator;


    public function __construct(
        ManagerRegistry $doctrine,
        ValidatorInterface $validator
    ) {
        $this->despesas = new Despesas();
        $this->doctrine = $doctrine;
        $this->validator = $validator;
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

        $validaDespesaFachada = new ValidaDespesaFachada(
            $this->repositorio,
            $this->despesas,
            $this->validator
        );
        $validaDespesaFachada->valida();
        $this->repositorio->save($this->despesas, true);
    }


    public function delete()
    {
        $this->repositorio->remove($this->despesas, true);
    }
}
