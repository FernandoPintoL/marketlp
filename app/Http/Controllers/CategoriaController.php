<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Http\Requests\StoreCategoriaRequest;
use App\Http\Requests\UpdateCategoriaRequest;
use App\Services\PermissionService;
use App\Services\ResponseService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use App\Traits\CrudController;

class CategoriaController extends Controller
{
    use CrudController;
    protected Categoria $model;
    protected string $rutaVisita = 'Categoria';

    public function __construct()
    {
        $this->model = new Categoria();
    }
}
