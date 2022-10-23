<?php

namespace App\Helper;

use Exception;
use Throwable;

class ArulaException extends Exception
{
      // Redefine a exceção de forma que a mensagem não seja opcional
      public function __construct($message, $code = 0, Throwable $previous = null) {
        // código

        // garante que tudo está corretamente inicializado
        parent::__construct($message, $code, $previous);
    }
}
