<?php

namespace App\Http\Controllers;

use App\Models\UbicacionItem;
use App\Http\Requests\StoreUbicacionItemRequest;
use App\Http\Requests\UpdateUbicacionItemRequest;
use App\Traits\CrudController;

class UbicacionItemController extends Controller
{
    use CrudController;
    public UbicacionItem $model;
    public string $rutaVisita = 'UbicacionItem';
    public function __construct()
    {
        $this->model = new UbicacionItem();
    }
}
