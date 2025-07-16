<?php

namespace App\Http\Controllers;

use App\Models\PrecioItems;
use App\Http\Requests\StorePrecioItemsRequest;
use App\Http\Requests\UpdatePrecioItemsRequest;
use App\Traits\CrudController;

class PrecioItemsController extends Controller
{
    use CrudController;
    public PrecioItems $model;
    public string $rutaVisita = 'PrecioItems';
    public function __construct()
    {
        $this->model = new PrecioItems();
    }
}
