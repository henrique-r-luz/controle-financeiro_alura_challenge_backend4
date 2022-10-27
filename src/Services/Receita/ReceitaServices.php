<?php

namespace App\Services\Receita;

use App\Entity\FormEntradaDados;
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


    public function load(FormEntradaDados $form)
    {

        $form->repositorio = $this->repositorio;
        /**@var LoadInterface */
        $load = LoadFactory::getObject($form);
        $this->receita = $load->getReceita();
    }

    

    public function save()
    {

        $validaReceitaFachada = new ValidaReceitaFachada($this->repositorio, $this->receita);
        $validaReceitaFachada->valida();
        $this->repositorio->save($this->receita, true);
    }


    public function delete()
    {
        $this->repositorio->remove($this->receita, true);
    }
}
