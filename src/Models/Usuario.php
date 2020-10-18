<?php

namespace JbAuthSantum\Models;

use JbAuthSantum\Notifications\ResetPassword;
use JbGlobal\Models\Usuario as ModelsUsuario;
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
