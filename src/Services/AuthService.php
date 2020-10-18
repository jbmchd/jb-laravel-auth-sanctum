<?php

namespace JbAuthSantum\Services;

use JbGlobal\Exceptions\AuthException;
use JbGlobal\Repositories\UsuarioRepository as Repository;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Auth\Passwords\PasswordBroker;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use JbGlobal\Services\Service;

class AuthService extends Service
{
    public function __construct(Repository $repositorio)
    {
        parent::__construct($repositorio);
        $this->exception_class = AuthException::class;
    }

    public function registrar(array $dados)
    {
        $usuario = $this->repositorio->criar($dados);
        return $usuario;
    }

    public function buscarUsuario($email, $senha)
    {
        $usuario = $this->repositorio->buscarUsuarioEmail($email);
        if (!$usuario || !Hash::check($senha, $usuario->senha)) {
            $this->jbException('Credenciais Inválidas');
        }
        return $usuario;
    }

    public function gerarToken($usuario)
    {
        $cliente_id = request()->server('REMOTE_ADDR');
        $token = $usuario->createToken("sanctum-$cliente_id-{$usuario->email}");
        return $token;
    }

    public function sair($usuario)
    {
        $result = $usuario->tokens()->where('id', $usuario->currentAccessToken()->id)->delete();
        return $result;
    }

    public function sairDeTodosOsLogins($usuario)
    {
        $result = $usuario->tokens()->delete();
        return $result;
    }

    public function enviarEmailTrocarSenha($email)
    {
        $status = Password::sendResetLink(['email'=>$email]);
        return $status;
    }

    public function trocarSenha($email, $nova_senha, $token)
    {
        $broker = app(PasswordBroker::class);

        if (! $user = $this->repositorio->buscarUsuarioEmail($email)) {
            return Password::INVALID_USER;
        }

        if (! $broker->tokenExists($user, $token)) {
            return Password::INVALID_TOKEN;
        }

        $user->forceFill(['senha' => $nova_senha])->save();
        $user->setRememberToken(Str::random(60));

        event(new PasswordReset($user));

        $broker->deleteToken($user);

        return Password::PASSWORD_RESET;
    }
}
