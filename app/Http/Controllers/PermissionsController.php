<?php

namespace App\Http\Controllers;

use App\Models\Permissions;
use App\Http\Requests\StorePermissionsRequest;
use App\Http\Requests\UpdatePermissionsRequest;
use App\Services\PermissionService;
use App\Services\ResponseService;
use App\Traits\CrudController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class PermissionsController extends Controller
{
    use CrudController;
    public Permissions $model;
    public $rutaVisita = 'Permissions';
    public function __construct()
    {
        $this->model = new Permissions();
    }
}
