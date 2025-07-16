<?php

namespace App\Http\Controllers;

use App\Models\TipoCambio;
use App\Http\Requests\StoreTipoCambioRequest;
use App\Http\Requests\UpdateTipoCambioRequest;
use App\Traits\CrudController;

class TipoCambioController extends Controller
{
    use CrudController;
    public TipoCambio $model;
    public string $rutaVisita = 'TipoCambio';
    public function __construct(){
        $this->model = new TipoCambio();
    }
}
