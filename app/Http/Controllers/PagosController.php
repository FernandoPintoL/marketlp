<?php

namespace App\Http\Controllers;

use App\Models\Pagos;
use App\Http\Requests\StorePagosRequest;
use App\Http\Requests\UpdatePagosRequest;
use App\Traits\CrudController;

class PagosController extends Controller
{
    use CrudController;
    public Pagos $model;
    public string $rutaVisita = 'Pagos';
    public function __construct()
    {
        $this->model = new Pagos();
    }
}
