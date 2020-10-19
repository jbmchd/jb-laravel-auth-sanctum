<?php

namespace JbSanctum\Models;

use JbGlobal\Models\Usuario as ModelsUsuario;
use JbSanctum\Notifications\ResetPassword;
use Laravel\Sanctum\HasApiTokens;

class Usuario extends ModelsUsuario
{
    use HasApiTokens;

    /**
     * Send the password reset notification.
     *
     * @param  string  $token
     * @return void
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPassword($token));
    }
}
