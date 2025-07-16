<?php

namespace App\Http\Controllers;

use App\Models\AperturaCaja;
use App\Http\Requests\StoreAperturaCajaRequest;
use App\Http\Requests\UpdateAperturaCajaRequest;
use App\Traits\CrudController;

class AperturaCajaController extends Controller
{
    use CrudController;
    public AperturaCaja $model;
    public string $rutaVisita = 'AperturaCaja';
    public function __construct()
    {
        $this->model = new AperturaCaja();
    }
}
