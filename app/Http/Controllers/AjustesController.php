<?php

namespace App\Http\Controllers;

use App\Models\Ajustes;
use App\Http\Requests\StoreAjustesRequest;
use App\Http\Requests\UpdateAjustesRequest;
use App\Services\PermissionService;
use App\Services\ResponseService;
use App\Traits\CrudController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class AjustesController extends Controller
{
    use CrudController;
    public Ajustes $model;
    public $rutaVisita = 'Ajustes';
    public function __construct()
    {
        $this->model = new Ajustes();
    }
}
