<?php

namespace App\Controller;

use App\Helper\Metodo;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class LoginCheckController extends AbstractController
{
    #[Route('/login_check', methods: [Metodo::post])]
    public function login()
    {
    }
}
