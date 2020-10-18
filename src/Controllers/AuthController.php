<?php

namespace JbAuthSantum\Controllers;

use Illuminate\Support\Facades\Password;
use JbAuthSantum\Requests\AuthRequest as Request;
use JbAuthSantum\Services\AuthService;
use JbGlobal\Controllers\Controller;

class AuthController extends Controller
{
    public function __construct(AuthService $authService)
    {
        parent::__construct($authService);
    }

    public function registrar(Request $request)
    {
        $dados = $request->all();
        $result = $this->servico->registrar($dados);
        return response()->jbSuccess($result);
    }

    public function entrar(Request $request)
    {
        $dados = $request->all();
        $usuario = $this->servico->buscarUsuario($dados['email'], $dados['senha']);
        $token = $this->servico->gerarToken($usuario);
        $result = [
            'token' => $token,
            'type' => 'Bearer',
        ];
        return response()->jbSuccess($result);
    }

    public function eu(Request $request)
    {
        $eu = $request->user();
        return response()->jbSuccess($eu);
    }

    public function sair(Request $request)
    {
        $user = $request->user();
        $result = $this->servico->sair($user);
        return response()->jbSuccess($result, 'Logout feito sucesso.');
    }

    public function enviarEmailTrocarSenha(Request $request)
    {
        $email = $request->email;
        $status = $this->servico->enviarEmailTrocarSenha($email);
        if($status === Password::RESET_LINK_SENT){
            return response()->jbSuccess(true, 'Email para redefinição de senha enviado com sucesso');
        } else if($status === Password::INVALID_USER){
            $this->jbException('Usuário inválido');
        } else if($status === Password::RESET_THROTTLED){
            $this->jbException('Operação interrompida, talvez esteja havendo excesso de tentativas.');
        }

        $this->jbException('Ocorreu algum problema com a operação');

    }

    public function trocarSenha(Request $request)
    {
        $dados = $request->only('email', 'senha', 'token');
        $status = $this->servico->trocarSenha($dados['email'], $dados['senha'], $dados['token']);

        if($status === Password::PASSWORD_RESET){
            return response()->jbSuccess(true, 'Senha redefinida com sucesso');
        } else if($status === Password::INVALID_USER){
            $this->jbException('Usuário inválido');
        } else if($status === Password::INVALID_TOKEN){
            $this->jbException('Token inválido');
        }

        $this->jbException('Ocorreu algum problema com a operação');

    }
}