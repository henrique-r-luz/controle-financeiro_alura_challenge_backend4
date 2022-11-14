<?php

namespace App\Services\Receita;

use App\Entity\Receita;
use App\Services\LoadFactory;
use App\Entity\FormEntradaDados;
use App\Repository\ReceitaRepository;
use Doctrine\Persistence\ManagerRegistry;
use App\Validacao\Receita\ValidaReceitaFachada;
use Symfony\Component\Validator\Validator\ValidatorInterface;


class ReceitaServices
{


    private Receita $receita;
    private ManagerRegistry $doctrine;
    private ReceitaRepository $repositorio;
    private ValidatorInterface $validator;


    public function __construct(
        ManagerRegistry $doctrine,
        ValidatorInterface $validator
    ) {
        $this->receita = new Receita();
        $this->doctrine = $doctrine;
        $this->repositorio = $this->doctrine->getRepository(Receita::class);
        $this->validator = $validator;
    }


    public function load(FormEntradaDados $form)
    {

        $form->repositorio = $this->repositorio;
        /**@var LoadInterface */
        $load = LoadFactory::getObject($form);
        $this->receita = $load->getEntidade();
    }



    public function save()
    {

        $validaReceitaFachada = new ValidaReceitaFachada(
            $this->repositorio,
            $this->receita,
            $this->validator
        );
        $validaReceitaFachada->valida();
        $this->repositorio->save($this->receita, true);
    }


    public function delete()
    {
        $this->repositorio->remove($this->receita, true);
    }
}
