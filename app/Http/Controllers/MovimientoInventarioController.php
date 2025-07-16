<?php

namespace App\Http\Controllers;

use App\Models\MovimientoInventario;
use App\Http\Requests\StoreMovimientoInventarioRequest;
use App\Http\Requests\UpdateMovimientoInventarioRequest;
use App\Traits\CrudController;

class MovimientoInventarioController extends Controller
{
    use CrudController;
    public MovimientoInventario $model;
    public string $rutaVisita = 'MovimientoInventario';
    public function __construct()
    {
        $this->model = new MovimientoInventario();
    }
}
