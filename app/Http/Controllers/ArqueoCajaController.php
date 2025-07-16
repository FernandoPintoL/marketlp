<?php

namespace App\Http\Controllers;

use App\Models\ArqueoCaja;
use App\Http\Requests\StoreArqueoCajaRequest;
use App\Http\Requests\UpdateArqueoCajaRequest;
use App\Traits\CrudController;

class ArqueoCajaController extends Controller
{
    use CrudController;
    public ArqueoCaja $model;
    public string $rutaVisita = 'ArqueoCaja';
    public function __construct()
    {
        $this->model = new ArqueoCaja();
    }
}
