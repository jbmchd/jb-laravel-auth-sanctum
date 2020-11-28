<?php

namespace JbSanctum\Repositories;

use JbGlobal\Repositories\UsuarioRepository as RepositoriesUsuarioRepository;
use JbSanctum\Models\Usuario as Model;

class UsuarioRepository extends RepositoriesUsuarioRepository
{
    protected $model = Model::class;
}
