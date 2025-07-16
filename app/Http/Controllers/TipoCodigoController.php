<?php

namespace App\Http\Controllers;

use App\Models\TipoCodigo;
use App\Http\Requests\StoreTipoCodigoRequest;
use App\Http\Requests\UpdateTipoCodigoRequest;
use App\Traits\CrudController;

class TipoCodigoController extends Controller
{
    use CrudController;
    public TipoCodigo $model;
    public string $rutaVisita = 'TipoCodigo';
    public function __construct()
    {
        $this->model = new TipoCodigo();
    }
}
