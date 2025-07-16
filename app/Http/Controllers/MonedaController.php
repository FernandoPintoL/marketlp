<?php

namespace App\Http\Controllers;

use App\Models\Moneda;
use App\Http\Requests\StoreMonedaRequest;
use App\Http\Requests\UpdateMonedaRequest;
use App\Traits\CrudController;

class MonedaController extends Controller
{
    use CrudController;
    public Moneda $model;
    public string $rutaVisita = 'Moneda';
    public function __construct()
    {
        $this->model = new Moneda();
    }
}
