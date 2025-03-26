<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\{
    AlmacenController,
    CategoriaController,
    ClienteController,
    EmpleadoController,
    EmpleadoCargoController,
    EmpresaController,
    InventarioController,
    ItemController,
    MenuController,
    PermissionsController,
    ProveedorController,
    RolesController,
    SectorController,
    TipoDocumentoController,
    UnidadController,
    UserController
};

$resources = [
    'almacen' => AlmacenController::class,
    'categoria' => CategoriaController::class,
    'cliente' => ClienteController::class,
    'empleado' => EmpleadoController::class,
    'empleado-cargo' => EmpleadoCargoController::class,
    'empresa' => EmpresaController::class,
    'inventario' => InventarioController::class,
    'item' => ItemController::class,
    'menu' => MenuController::class,
    'permissions' => PermissionsController::class,
    'proveedor' => ProveedorController::class,
    'roles' => RolesController::class,
    'sector' => SectorController::class,
    'tipo-documento' => TipoDocumentoController::class,
    'unidad' => UnidadController::class,
    'users' => UserController::class,
];

Route::get('/', function () {
    return Inertia::render('Welcome');
})->name('home');

Route::get('dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';

foreach ($resources as $key => $controller) {
    Route::resource("/$key", $controller);
    Route::post("/$key/query", [$controller, 'query'])->name("$key.query");
}
