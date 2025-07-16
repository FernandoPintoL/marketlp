<?php

namespace App\Http\Controllers;

use App\Models\CajaUser;
use App\Http\Requests\StoreCajaUserRequest;
use App\Http\Requests\UpdateCajaUserRequest;
use App\Traits\CrudController;

class CajaUserController extends Controller
{
    use CrudController;
    public CajaUser $model;
    public string $rutaVisita = 'CajaUser';
    public function __construct()
    {
        $this->model = new CajaUser();
    }
}
