<?php

namespace App\Http\Controllers;

use App\Models\Caja;
use App\Http\Requests\StoreCajaRequest;
use App\Http\Requests\UpdateCajaRequest;
use App\Traits\CrudController;

class CajaController extends Controller
{
    use CrudController;
    public Caja $model;
    public string $rutaVisita = 'Caja';
    public function __construct()
    {
        $this->model = new Caja();
    }
}
