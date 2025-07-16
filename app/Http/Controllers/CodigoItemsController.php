<?php

namespace App\Http\Controllers;

use App\Models\CodigoItems;
use App\Http\Requests\StoreCodigoItemsRequest;
use App\Http\Requests\UpdateCodigoItemsRequest;
use App\Traits\CrudController;

class CodigoItemsController extends Controller
{
    use CrudController;
    public CodigoItems $model;
    public string $rutaVisita = 'CodigoItems';
    public function __construct()
    {
        $this->model = new CodigoItems();
    }
}
