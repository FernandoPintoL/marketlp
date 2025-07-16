<?php

namespace App\Http\Controllers;

use App\Models\TipoUbicacionItem;
use App\Http\Requests\StoreTipoUbicacionItemRequest;
use App\Http\Requests\UpdateTipoUbicacionItemRequest;
use App\Traits\CrudController;

class TipoUbicacionItemController extends Controller
{
    use CrudController;
    public TipoUbicacionItem $model;
    public string $rutaVisita = 'TipoUbicacionItem';
    public function __construct()
    {
        $this->model = new TipoUbicacionItem();
    }
}
