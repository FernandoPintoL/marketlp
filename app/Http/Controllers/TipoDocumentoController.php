<?php

namespace App\Http\Controllers;

use App\Models\TipoDocumento;
use App\Traits\CrudController;

class TipoDocumentoController extends Controller
{
    use CrudController;
    public TipoDocumento $model;
    public $rutaVisita = 'TipoDocumento';
    public function __construct()
    {
        $this->model = new TipoDocumento();
    }
}
