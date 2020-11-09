<?php

namespace JbSanctum\Exceptions;

use JbGlobal\Exceptions\AuthException as ExceptionsAuthException;

/**
* AppException
*/
class AuthException extends ExceptionsAuthException
{
    protected $nivel = parent::LOG_NIVEL_CRITICAL;

    public function getLogNivel(){
        return $this->nivel;
    }
}
