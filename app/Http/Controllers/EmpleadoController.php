<?php

namespace App\Http\Controllers;

use App\Models\Empleado;
use App\Http\Requests\StoreEmpleadoRequest;
use App\Http\Requests\UpdateEmpleadoRequest;
use App\Models\EmpleadoCargo;
use App\Models\TipoDocumento;
use App\Services\PermissionService;
use App\Services\ResponseService;
use App\Traits\CrudController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class EmpleadoController extends Controller
{
    use CrudController;
    public Empleado $model;
    public $rutaVisita = 'Empleado';
    public function __construct()
    {
        $this->model = new Empleado();
    }
}
