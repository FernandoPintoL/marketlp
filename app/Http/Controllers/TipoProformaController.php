<?php

namespace App\Http\Controllers;

use App\Models\TipoProforma;
use App\Http\Requests\StoreTipoProformaRequest;
use App\Http\Requests\UpdateTipoProformaRequest;
use App\Traits\CrudController;

class TipoProformaController extends Controller
{
    use CrudController;
    public TipoProforma $model;
    public string $rutaVisita = 'TipoProforma';
    public function __construct()
    {
        $this->model = new TipoProforma();
    }
}
