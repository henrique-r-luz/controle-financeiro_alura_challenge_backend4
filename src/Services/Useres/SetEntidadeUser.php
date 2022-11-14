<?php

namespace App\Services\Useres;

use App\Entity\User;
use App\Entity\FormEntradaDados;
use App\Services\SetEntidadeInterface;


class SetEntidadeUser implements SetEntidadeInterface
{
    const email = 'email';
    const senha = 'senha';
    const roles = 'roles';

    private User $entidade;
    private $dados;

    public function __construct(
        FormEntradaDados $form,
        $dados
    ) {
        $this->entidade = $form->entidade;
        $this->dados = $dados;
    }

    public function set()
    {
        $kernel = $GLOBALS['app'];
        $container = $kernel->getContainer();
        $passwordHasher = $container->get('hash_password');
        $hashedPassword = $passwordHasher->hashPassword(
            $this->entidade,
            $this->dados[self::senha],
        );
        $this->entidade->setEmail($this->dados[self::email])
            ->setRoles([$this->dados[self::roles]])
            ->setPassword($hashedPassword);
        return $this->entidade;
    }
}
