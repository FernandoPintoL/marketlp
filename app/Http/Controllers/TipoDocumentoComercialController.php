<?php

namespace App\Http\Controllers;

use App\Models\TipoDocumentoComercial;
use App\Traits\CrudController;

class TipoDocumentoComercialController extends Controller
{
    use CrudController;
    public TipoDocumentoComercial $model;
    public string $rutaVisita = 'TipoDocumentoComercial';
    public function __construct()
    {
        $this->model = new TipoDocumentoComercial();
    }
}
