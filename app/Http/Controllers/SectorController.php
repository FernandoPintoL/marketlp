<?php

namespace App\Http\Controllers;

use App\Models\Sector;
use App\Traits\CrudController;

class SectorController extends Controller
{
    use CrudController;
    public Sector $model;
    public $rutaVisita = 'Sector';
    public function __construct()
    {
        $this->model = new Sector();
    }
}
