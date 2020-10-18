<?php

namespace JbAuthSantum\Repositories;

use JbAuthSantum\Models\Usuario as Model;
use JbGlobal\Repositories\Repository;

class UsuarioRepository extends Repository
{
    public function __construct(Model $model)
    {
        parent::__construct($model);
    }

    public function buscarUsuarioEmail(String $email)
    {
        $usuario = $this->model->where(['email'=>$email])->first();
        return $usuario;
    }

}
