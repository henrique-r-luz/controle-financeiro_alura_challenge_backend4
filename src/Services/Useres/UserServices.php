<?php

namespace App\Services\Useres;

use App\Entity\User;
use App\Services\LoadFactory;
use App\Entity\FormEntradaDados;
use App\Validacao\User\ValidaUserFachada;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class UserServices
{


    public function __construct(
        ManagerRegistry $doctrine,
        ValidatorInterface $validator
    ) {
        $this->user = new User();
        $this->doctrine = $doctrine;
        $this->validator = $validator;
        $this->repositorio = $this->doctrine->getRepository(User::class);
    }

    public function load(FormEntradaDados $form)
    {
        $form->repositorio = $this->repositorio;

        /**@var LoadInterface */
        $load = LoadFactory::getObject($form);
        $this->user = $load->getEntidade();
    }


    public function save()
    {
        $validaUserFachada = new ValidaUserFachada(
            $this->user,
            $this->validator
        );
        $validaUserFachada->valida();
        $this->repositorio->save($this->user, true);
    }


    public function delete()
    {
        $this->repositorio->remove($this->user, true);
    }
}
