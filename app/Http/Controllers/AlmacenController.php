<?php

namespace App\Http\Controllers;

use App\Models\Almacen;
use App\Http\Requests\StoreAlmacenRequest;
use App\Http\Requests\UpdateAlmacenRequest;
use App\Services\PermissionService;
use App\Services\ResponseService;
use App\Traits\CrudController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class AlmacenController extends Controller
{
    use CrudController;
    public Almacen $model;
    public string $rutaVisita = 'Almacen';
    public function __construct()
    {
        $this->model = new Almacen();
    }
}
