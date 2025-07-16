<?php

namespace App\Http\Controllers;

use App\Models\Unidad;
use App\Traits\CrudController;

class UnidadController extends Controller
{
    use CrudController;
    public Unidad $model;
    public $rutaVisita = 'Unidad';
    public function __construct()
    {
        $this->model = new Unidad();
    }
}
