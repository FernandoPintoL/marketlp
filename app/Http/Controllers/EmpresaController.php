<?php

namespace App\Http\Controllers;

use App\Models\Empleado;
use App\Models\Empresa;
use App\Http\Requests\StoreEmpresaRequest;
use App\Http\Requests\UpdateEmpresaRequest;
use App\Services\ResponseService;
use App\Traits\CrudController;
use Illuminate\Http\Request;

class EmpresaController extends Controller
{
    use CrudController;
    public Empresa $model;
    public $rutaVisita = 'Empresa';
    public function __construct()
    {
        $this->model = new Empresa();
    }
}
