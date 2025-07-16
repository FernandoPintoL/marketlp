<?php

namespace App\Http\Controllers;

use App\Models\EmpleadoCargo;
use App\Http\Requests\StoreEmpleadoCargoRequest;
use App\Http\Requests\UpdateEmpleadoCargoRequest;
use App\Services\PermissionService;
use App\Services\ResponseService;
use App\Traits\CrudController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class EmpleadoCargoController extends Controller
{
    use CrudController;
    public EmpleadoCargo $model;
    public $rutaVisita = 'EmpleadoCargo';
    public function __construct()
    {
        $this->model = new EmpleadoCargo();
    }
}
