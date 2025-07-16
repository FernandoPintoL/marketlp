<?php

namespace App\Http\Controllers;

use App\Models\TipoMovimiento;
use App\Http\Requests\StoreTipoMovimientoRequest;
use App\Http\Requests\UpdateTipoMovimientoRequest;
use App\Traits\CrudController;

class TipoMovimientoController extends Controller
{
    use CrudController;
    public TipoMovimiento $model;
    public string $rutaVisita = 'TipoMovimiento';
    public function __construct()
    {
        $this->model = new TipoMovimiento();
    }
}
