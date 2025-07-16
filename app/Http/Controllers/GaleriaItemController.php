<?php

namespace App\Http\Controllers;

use App\Models\GaleriaItem;
use App\Http\Requests\StoreGaleriaItemRequest;
use App\Http\Requests\UpdateGaleriaItemRequest;
use App\Traits\CrudController;

class GaleriaItemController extends Controller
{
    use CrudController;
    protected GaleriaItem $model;
    protected string $rutaVisita = 'GaleriaItem';
    public function __construct()
    {
        $this->model = new GaleriaItem();
    }
}
