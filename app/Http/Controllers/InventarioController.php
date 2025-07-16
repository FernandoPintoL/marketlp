<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Inventario;
use App\Http\Requests\StoreInventarioRequest;
use App\Http\Requests\UpdateInventarioRequest;
use App\Services\PermissionService;
use App\Services\ResponseService;
use App\Traits\CrudController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class InventarioController extends Controller
{
    use CrudController;
    public Inventario $model;
    public $rutaVisita = 'Inventario';
    public function __construct()
    {
        $this->model = new Inventario();
    }
}
