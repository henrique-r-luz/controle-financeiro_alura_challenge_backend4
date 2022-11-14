<?php

namespace App\Validacao\User;

use App\Entity\User;
use App\Validacao\Receita\ValidaEntidade;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class ValidaUserFachada
{
    private $user;
    private ValidatorInterface $validator;

    public function __construct(
        User $user,
        ValidatorInterface $validator
    ) {
        $this->user = $user;
        $this->validator = $validator;
    }


    public function valida()
    {
        $validaEntidade =  new ValidaEntidade($this->validator, $this->user);
        $validaEntidade->valida();
    }
}
