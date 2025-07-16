<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Proveedor;
use App\Http\Requests\StoreProveedorRequest;
use App\Http\Requests\UpdateProveedorRequest;
use App\Models\TipoDocumento;
use App\Services\PermissionService;
use App\Services\ResponseService;
use App\Traits\CrudController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class ProveedorController extends Controller
{
    use CrudController;
    public Proveedor $model;
    public $rutaVisita = 'Proveedor';
    public function __construct()
    {
        $this->model = new Proveedor();
    }
}
