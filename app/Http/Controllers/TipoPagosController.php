<?php

namespace App\Http\Controllers;

use App\Models\TipoPagos;
use App\Http\Requests\StoreTipoPagosRequest;
use App\Http\Requests\UpdateTipoPagosRequest;

class TipoPagosController extends Controller
{
    use CrudController;
    public TipoPagos $model;
    public string $rutaVisita = 'TipoPagos';
    public function __construct()
    {
        $this->model = new TipoPagos();
    }
}
