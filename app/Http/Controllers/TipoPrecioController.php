<?php

namespace App\Http\Controllers;

use App\Models\TipoPrecio;
use App\Http\Requests\StoreTipoPrecioRequest;
use App\Http\Requests\UpdateTipoPrecioRequest;
use App\Traits\CrudController;

class TipoPrecioController extends Controller
{
    use CrudController;
    public TipoPrecio $model;
    public string $rutaVisita = 'TipoPrecio';
    public function __construct()
    {
        $this->model = new TipoPrecio();
    }
}
