<?php

namespace App\Http\Controllers;

use App\Models\MovimientoCaja;
use App\Http\Requests\StoreMovimientoCajaRequest;
use App\Http\Requests\UpdateMovimientoCajaRequest;
use App\Traits\CrudController;

class MovimientoCajaController extends Controller
{
    use CrudController;
    public MovimientoCaja $model;
    public string $rutaVisita = 'MovimientoCaja';
    public function __construct()
    {
        $this->model = new MovimientoCaja();
    }
}
