<?php

namespace App\Http\Controllers;

use App\Models\DocumentoComercial;
use App\Http\Requests\StoreDocumentoComercialRequest;
use App\Http\Requests\UpdateDocumentoComercialRequest;
use App\Traits\CrudController;

class DocumentoComercialController extends Controller
{
    use CrudController;
    public DocumentoComercial $model;
    public string $rutaVisita = 'DocumentoComercial';
    public function __construct()
    {
        $this->model = new DocumentoComercial();
    }
}
