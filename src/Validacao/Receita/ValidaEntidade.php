<?php

namespace App\Validacao\Receita;

use App\Helper\ArulaException;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class ValidaEntidade
{

    private ValidatorInterface $validator;
    private $entidade;

    public function __construct(ValidatorInterface $validator, $entidade)
    {
        $this->validator = $validator;
        $this->entidade = $entidade;
    }

    public function valida()
    {
        $errors = $this->validator->validate($this->entidade);
        foreach ($errors as $erro) {
            throw new ArulaException($erro->getMessage());
        }
    }
}
