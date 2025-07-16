<?php

namespace App\Http\Controllers;

use App\Models\UserCaja;
use App\Http\Requests\StoreUserCajaRequest;
use App\Http\Requests\UpdateUserCajaRequest;
use App\Traits\CrudController;

class UserCajaController extends Controller
{
    use CrudController;
    public UserCaja $model;
    public string $rutaVisita = 'UserCaja';
    public function __construct()
    {
        $this->model = new UserCaja();
    }
}
