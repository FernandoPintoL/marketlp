<?php

namespace App\Http\Controllers;

use App\Models\Sucursal;
use App\Http\Requests\StoreSucursalRequest;
use App\Http\Requests\UpdateSucursalRequest;
use App\Traits\CrudController;

class SucursalController extends Controller
{
    use CrudController;
    public Sucursal $model;
    public string $rutaVisita = 'Sucursal';
    public function __construct()
    {
        $this->model = new Sucursal();
    }
}
