<?php

namespace App\Http\Controllers;

use App\Models\DetalleMovimiento;
use App\Http\Requests\StoreDetalleMovimientoRequest;
use App\Http\Requests\UpdateDetalleMovimientoRequest;
use App\Traits\CrudController;

class DetalleMovimientoController extends Controller
{
    use CrudController;
    public DetalleMovimiento $model;
    public string $rutaVisita = 'DetalleMovimiento';
    public function __construct()
    {
        $this->model = new DetalleMovimiento();
    }
}
