<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Cliente;
use App\Http\Requests\StoreClienteRequest;
use App\Http\Requests\UpdateClienteRequest;
use App\Models\EmpleadoCargo;
use App\Models\TipoDocumento;
use App\Services\PermissionService;
use App\Services\ResponseService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class ClienteController extends Controller
{
    public Cliente $model;
    public $rutaVisita = 'Cliente';
    public function __construct()
    {
        $this->model = new Cliente();
    }
}
