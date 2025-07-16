<?php

namespace App\Http\Controllers;

use App\Models\CajaEmpleado;
use App\Http\Requests\StoreCajaEmpleadoRequest;
use App\Http\Requests\UpdateCajaEmpleadoRequest;
use App\Traits\CrudController;

class CajaEmpleadoController extends Controller
{
    use CrudController;
    public CajaEmpleado $model;
    public string $rutaVisita = 'CajaEmpleado';
    public function __construct()
    {
        $this->model = new CajaEmpleado();
    }
}
